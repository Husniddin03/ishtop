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
    public function index()
    {
        return view('worker.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('worker.create');
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
            'phone' => 'nullable|string|max:20',
            'telegram' => 'nullable|string|max:255',
            'facebook' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
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
            ->route('workers.show', $worker->id)
            ->with('success', 'Ishchi muvaffaqiyatli yaratildi!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('worker.show', compact('id'));
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
