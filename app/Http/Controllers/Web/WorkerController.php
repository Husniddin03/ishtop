<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Region;
use App\Models\User;
use App\Models\UserData;
use App\Models\Village;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class WorkerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Worker::query()->with(['user.userData', 'user.userContact']);

        // Search by name
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->whereHas('user', function ($q) use ($searchTerm) {
                $q->where('name', 'like', "%{$searchTerm}%")
                    ->orWhereHas('userData', function ($q2) use ($searchTerm) {
                        $q2->where('first_name', 'like', "%{$searchTerm}%")
                            ->orWhere('last_name', 'like', "%{$searchTerm}%");
                    });
            });
        }

        // Apply location filters
        if ($request->filled('region')) {
            $query->whereHas('user.userData', function ($q) use ($request) {
                $q->where('region', $request->region);
            });
        }

        if ($request->filled('district')) {
            $query->whereHas('user.userData', function ($q) use ($request) {
                $q->where('district', $request->district);
            });
        }

        if ($request->filled('village')) {
            $query->whereHas('user.userData', function ($q) use ($request) {
                $q->where('village', $request->village);
            });
        }

        // Apply gender filter
        if ($request->filled('gender')) {
            $query->whereHas('user.userData', function ($q) use ($request) {
                $q->where('gender', $request->gender);
            });
        }

        // Apply age filters
        if ($request->filled('min_age') || $request->filled('max_age')) {
            $query->whereHas('user.userData', function ($q) use ($request) {
                if ($request->filled('min_age')) {
                    $q->whereRaw('TIMESTAMPDIFF(YEAR, birthday, CURDATE()) >= ?', [$request->min_age]);
                }
                if ($request->filled('max_age')) {
                    $q->whereRaw('TIMESTAMPDIFF(YEAR, birthday, CURDATE()) <= ?', [$request->max_age]);
                }
            });
        }

        // Apply height filters
        if ($request->filled('min_height')) {
            $query->whereHas('user.userData', function ($q) use ($request) {
                $q->where('height', '>=', $request->min_height);
            });
        }

        if ($request->filled('max_height')) {
            $query->whereHas('user.userData', function ($q) use ($request) {
                $q->where('height', '<=', $request->max_height);
            });
        }

        // Apply weight filters
        if ($request->filled('min_weight')) {
            $query->whereHas('user.userData', function ($q) use ($request) {
                $q->where('weight', '>=', $request->min_weight);
            });
        }

        if ($request->filled('max_weight')) {
            $query->whereHas('user.userData', function ($q) use ($request) {
                $q->where('weight', '<=', $request->max_weight);
            });
        }

        // Apply sorting
        switch ($request->get('sort', 'newest')) {
            case 'oldest':
                $query->orderBy('created_at');
                break;
            case 'age_young':
                $query->orderByRaw('(SELECT TIMESTAMPDIFF(YEAR, birthday, CURDATE()) FROM user_data WHERE user_data.user_id = users.id)');
                break;
            case 'age_old':
                $query->orderByRaw('(SELECT TIMESTAMPDIFF(YEAR, birthday, CURDATE()) FROM user_data WHERE user_data.user_id = users.id) DESC');
                break;
            case 'name_asc':
                $query->orderByRaw('(SELECT CONCAT(first_name, " ", last_name) FROM user_data WHERE user_data.user_id = users.id)');
                break;
            case 'name_desc':
                $query->orderByRaw('(SELECT CONCAT(first_name, " ", last_name) FROM user_data WHERE user_data.user_id = users.id) DESC');
                break;
            default:
                $query->orderByDesc('created_at');
        }

        $workers = $query->paginate(12)->withQueryString();
        $regions = Region::with('districts.villages')->get();

        return view('worker.index', compact('workers', 'regions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        if (!$user instanceof User) {
            throw new \Exception('Authenticated user is not an instance of the User model.');
        }
        $userData = $user->userData;
        $userContact = $user->userContact;
        $regions = Region::all();
        return view('worker.create', compact('userData', 'userContact', 'regions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $user = Auth::user();
        if (!$user instanceof User) {
            throw new \Exception('Authenticated user is not an instance of the User model.');
        }

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'bio' => 'nullable|string|max:1000',
            'gender' => 'nullable|in:male,female',
            'height' => 'nullable|numeric|min:0',
            'weight' => 'nullable|numeric|min:0',
            'birthday' => 'nullable|date|before:today',
            'country' => 'nullable|string|max:100',
            'region' => 'nullable|exists:regions,id',
            'district' => 'nullable|exists:districts,id',
            'village' => 'nullable|exists:villages,id',
            'address' => 'nullable|string|max:500',
            'phone' => 'required|string|max:20',
            'telegram' => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'latitude' => 'nullable',
            'longitude' => 'nullable',
        ]);

        // Ishni yaratish
        $worker = $user->userData()->updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'bio' => $validated['bio'],
                'gender' => $validated['gander'] ?? null,
                'height' => $validated['height'] ?? null,
                'weight' => $validated['weight'] ?? null,
                'birthday' => $validated['birthday'],
                'country' => $validated['country'],
                'region' => is_numeric($validated['region']) ? Region::where('id', $validated['region'])->first()->name_uz : $validated['region'],
                'district' => is_numeric($validated['district']) ? District::where('id', $validated['district'])->first()->name_uz : $validated['district'],
                'village' => is_numeric($validated['village']) ? Village::where('id', $validated['village'])->first()->name_uz : $validated['village'],
                'address' => $validated['address'] ?? null,
                'latitude' => $validated['latitude'] ?? null,
                'longitude' => $validated['longitude'] ?? null,
            ]
        );

        $user->update([
            'name' => $validated['first_name'] . ' ' . $validated['last_name'],
        ]);

        // Rasmlarni saqlash
        if ($request->hasFile('avatar')) {
            // Eski rasmni o'chirish
            if ($user->avatar && Storage::exists('public/' . $user->avatar)) {
                Storage::delete('public/' . $user->avatar);
            }

            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $path;
            $user->save();
        }


        $user->userContact()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'phone' => $validated['phone'],
                'telegram' => $validated['telegram'],
                'facebook' => $validated['facebook'],
                'instagram' => $validated['instagram'],
            ]
        );

        $user->worker()->updateOrCreate(
            ['user_id' => $user->id],
        );

        return redirect()
            ->route('workers.show', $user->worker->id)
            ->with('success', 'Ishchi muvaffaqiyatli yaratildi!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        Worker::findOrFail($id)->user->userData()->increment('views_count');
        $worker = Worker::find($id);
        return view('worker.show', compact('worker'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
