<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Region;
use App\Models\User;
use App\Models\Village;
use App\Models\Work;
use App\Models\WorkImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Work::query()->with(['user', 'images']);

        // Apply filters
        if ($request->filled('region')) {
            $query->where('region', $request->region);
        }

        if ($request->filled('district')) {
            $query->where('district', $request->district);
        }

        if ($request->filled('village')) {
            $query->where('village', $request->village);
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        if ($request->filled('lunch')) {
            $query->where('lunch', $request->lunch == '1');
        }

        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        if ($request->filled('how_much_people')) {
            $query->where('how_much_people', $request->how_much_people);
        }

        if ($request->filled('min_age')) {
            $query->where('age', '>=', $request->min_age);
        }

        if ($request->filled('max_age')) {
            $query->where('age', '<=', $request->max_age);
        }

        // Apply sorting
        switch ($request->get('sort', 'newest')) {
            case 'oldest':
                $query->orderBy('created_at');
                break;
            case 'price_high':
                $query->orderByDesc('price');
                break;
            case 'price_low':
                $query->orderBy('price');
                break;
            case 'most_viewed':
                $query->orderByDesc('read_count');
                break;
            default:
                $query->orderByDesc('created_at');
        }

        $works = $query->paginate(12)->withQueryString();
        $workTypes = Work::all()->groupBy('type');
        $regions = Region::with('districts.villages')->get();

        return view('work.index', compact('works', 'regions', 'workTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    // WorkController.php

    public function create()
    {
        $regions = Region::all();
        return view('work.create', compact('regions'));
    }

    public function store(Request $request)
    {

        $user = Auth::user();
        if (!$user instanceof User) {
            throw new \Exception('Authenticated user is not an instance of the User model.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'how_much_people' => 'required|integer|min:1',
            'gender' => 'nullable|in:male,female,any',
            'age' => 'nullable|integer|min:0',
            'description' => 'nullable|string',
            'lunch' => 'nullable|boolean',
            'country' => 'required|string',
            'region' => 'required',
            'district' => 'required',
            'village' => 'required',
            'address' => 'nullable|string|max:500',
            'when' => 'required|date',
            'start_time' => 'required',
            'finish_time' => 'required',
            'duration' => 'required|integer|min:1|max:30',
            'images.*' => 'nullable|image|max:10240', // 10MB
        ]);

        $validated1 = $request->validate([
            'phone' => 'required|string|max:20',
            'telegram' => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
        ]);

        // Ishni yaratish
        $work = Work::create([
            'user_id' => Auth::id(),
            'name' => $validated['name'],
            'type' => $validated['type'],
            'price' => $validated['price'],
            'how_much_people' => $validated['how_much_people'],
            'gender' => $validated['gender'] ?? null,
            'age' => $validated['age'] ?? null,
            'description' => $validated['description'] ?? null,
            'lunch' => $request->has('lunch'),
            'country' => $validated['country'],
            'region' => is_numeric($validated['region']) ? Region::where('id', $validated['region'])->first()->name_uz : $validated['region'],
            'district' => is_numeric($validated['district']) ? District::where('id', $validated['district'])->first()->name_uz : $validated['district'],
            'village' => is_numeric($validated['village']) ? Village::where('id', $validated['village'])->first()->name_uz : $validated['village'],
            'address' => $validated['address'] ?? null,
            'when' => $validated['when'],
            'start_time' => $validated['start_time'],
            'finish_time' => $validated['finish_time'],
            'duration' => $validated['duration'],
        ]);

        $user->userContact()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'phone' => $validated1['phone'],
                'telegram' => $validated1['telegram'],
                'facebook' => $validated1['facebook'],
                'instagram' => $validated1['instagram'],
            ]
        );

        // Rasmlarni saqlash
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                if ($image->isValid()) {
                    $path = $image->store('work_images', 'public');

                    WorkImage::create([
                        'work_id' => $work->id,
                        'image' => $path,
                    ]);
                }
            }
        }

        // Save the work model to ensure all data is persisted
        $work->save();

        return redirect()
            ->route('works.show', $work->id)
            ->with('success', 'Ish muvaffaqiyatli yaratildi!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        Work::findOrFail($id)->increment('read_count');
        $work = Work::find($id);
        return view('work.show', compact('work'));
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
