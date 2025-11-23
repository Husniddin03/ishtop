<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\StoreWorkVideoRequest;
use App\Http\Requests\API\UpdateWorkVideoRequest;
use App\Models\Work;
use App\Models\WorkVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WorkVideoController extends Controller
{
    // GET /works/{work}/videos
    public function index(Work $work)
    {
        $videos = $work->videos()->get();
        return response()->json($videos);
    }

    // POST /works/{work}/videos
    public function store(StoreWorkVideoRequest $request, Work $work)
    {

        if ($request->hasFile('video')) {
            $video = $request->file('video');
            $path = $video->store('work_videos', 'public');

            $workvideo = WorkVideo::create([
                'work_id' => $work->id,
                'url' => $path
            ]);


            return response()->json([
                'message' => 'Success',
                'data' => $workvideo
            ], 201);
        } else {
            return response()->json([
                'message' => 'Not saved',
            ], 201);
        }
    }

    // GET /works/{work}/videos/{video}
    public function show(Work $work, WorkVideo $video)
    {
        if ($video->work_id != $work->id) {
            return response()->json(['error' => 'Not found'], 404);
        }

        return response()->json($video);
    }

    // PUT/PATCH /works/{work}/videos/{video}
    public function update(UpdateWorkVideoRequest $request, Work $work, WorkVideo $video)
    {
        if ($video->work_id != $work->id) {
            return response()->json(['error' => 'Forbidden'], 403);
        }

        $data = $request->validated();

        if ($request->hasFile('video')) {
            $path = $request->file('video')->store('work_videos', 'public');
            $data['url'] = Storage::url($path);
        }

        $video->update($data);

        return response()->json($video);
    }

    // DELETE /works/{work}/videos/{video}
    public function destroy(Work $work, WorkVideo $video)
    {
        if ($video->work_id != $work->id) {
            return response()->json(['error' => 'Forbidden'], 403);
        }

        if (Storage::disk('public')->exists($video->url)) {
            Storage::disk('public')->delete($video->url);
        }

        $video->delete();
        return response()->json(['message' => 'Video deleted']);
    }
}
