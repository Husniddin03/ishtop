<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Region;
use App\Models\Work;
use App\Models\WorkImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('work.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    // WorkController.php

    public function create()
    {
        // Viloyatlarni districts va villages bilan yuklash
        $regions = Region::with(['districts.villages'])->get();

        return view('work.create', compact('regions'));
    }

    public function store(Request $request)
    {

        dd($request->all());
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
            'province' => 'required|exists:regions,id',
            'district' => 'nullable|exists:districts,id',
            'region' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:500',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'when' => 'required|date',
            'start_time' => 'required',
            'finish_time' => 'required',
            'duration' => 'required|integer|min:1|max:30',
            'images.*' => 'nullable|image|max:10240', // 10MB
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
            'province' => $validated['province'],
            'region' => $validated['region'] ?? null,
            'address' => $validated['address'] ?? null,
            'latitude' => $validated['latitude'] ?? null,
            'longitude' => $validated['longitude'] ?? null,
            'when' => $validated['when'],
            'start_time' => $validated['start_time'],
            'finish_time' => $validated['finish_time'],
            'duration' => $validated['duration'],
        ]);

        // Rasmlarni saqlash
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('work_images', 'public');

                WorkImage::create([
                    'work_id' => $work->id,
                    'image_path' => $path,
                ]);
            }
        }

        return redirect()
            ->route('work.index')
            ->with('success', 'Ish muvaffaqiyatli yaratildi!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('work.show', compact('id'));
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
