<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use App\Models\Work;
use App\Models\WorkConnection;
use App\Models\WorkLocation;
use App\Models\WorkPhoto;
use App\Models\WorkVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WorkController extends Controller
{
    // Works
    public function index()
    {
        $works = Work::with(['user', 'connections', 'locations', 'photos', 'videos'])->paginate(15);
        return view('works.index', compact('works'));
    }

    public function create()
    {
        return view('works.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'type' => 'nullable|string',
            'descrition' => 'nullable|string',
            'date' => 'nullable|date',
        ]);

        $work = Work::create($validated);

        return redirect()->route('works.show', $work)->with('success', 'Ish muvaffaqiyatli yaratildi!');
    }

    public function show(Work $work)
    {
        $work->load(['user', 'connections', 'locations', 'photos', 'videos']);
        return view('works.show', compact('work'));
    }

    public function edit(Work $work)
    {
        return view('works.edit', compact('work'));
    }

    public function update(Request $request, Work $work)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'nullable|string',
            'descrition' => 'nullable|string',
            'date' => 'nullable|date',
        ]);

        $work->update($validated);

        return redirect()->route('works.show', $work)->with('success', 'Ish yangilandi!');
    }

    public function destroy(Work $work)
    {
        // Rasmlarni o'chirish
        foreach ($work->photos as $photo) {
            Storage::disk('public')->delete($photo->url);
        }

        // Videolarni o'chirish
        foreach ($work->videos as $video) {
            Storage::disk('public')->delete($video->url);
        }

        $work->delete();

        return redirect()->route('works.index')->with('success', 'Ish o\'chirildi!');
    }

    // Work Connections
    public function storeConnection(Request $request, Work $work)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'nullable|url',
        ]);

        $work->connections()->create($validated);

        return redirect()->back()->with('success', 'Aloqa qo\'shildi!');
    }

    public function destroyConnection(WorkConnection $connection)
    {
        $connection->delete();
        return redirect()->back()->with('success', 'Aloqa o\'chirildi!');
    }

    // Work Locations
    public function storeLocation(Request $request, Work $work)
    {
        $validated = $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $work->locations()->create($validated);

        return redirect()->back()->with('success', 'Manzil qo\'shildi!');
    }

    public function destroyLocation(WorkLocation $location)
    {
        $location->delete();
        return redirect()->back()->with('success', 'Manzil o\'chirildi!');
    }

    // Work Photos
    public function storePhoto(Request $request, Work $work)
    {
        $validated = $request->validate([
            'photo' => 'required|image|max:5120',
        ]);

        $url = $request->file('photo')->store('works/photos', 'public');

        $work->photos()->create(['url' => $url]);

        return redirect()->back()->with('success', 'Rasm qo\'shildi!');
    }

    public function destroyPhoto(WorkPhoto $photo)
    {
        Storage::disk('public')->delete($photo->url);
        $photo->delete();
        return redirect()->back()->with('success', 'Rasm o\'chirildi!');
    }

    // Work Videos
    public function storeVideo(Request $request, Work $work)
    {
        $validated = $request->validate([
            'video' => 'required|mimes:mp4,avi,mov|max:51200',
        ]);

        $url = $request->file('video')->store('works/videos', 'public');

        $work->videos()->create(['url' => $url]);

        return redirect()->back()->with('success', 'Video qo\'shildi!');
    }

    public function destroyVideo(WorkVideo $video)
    {
        Storage::disk('public')->delete($video->url);
        $video->delete();
        return redirect()->back()->with('success', 'Video o\'chirildi!');
    }
}
