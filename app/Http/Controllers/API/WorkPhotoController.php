<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\StoreWorkPhotoRequest;
use App\Http\Requests\API\UpdateWorkPhotoRequest;
use App\Models\Work;
use App\Models\WorkPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WorkPhotoController extends Controller
{
    // GET /works/{work}/photos
    public function index(Work $work)
    {
        $photos = $work->photos()->get();
        return response()->json($photos);
    }


    public function store(StoreWorkPhotoRequest $request, Work $work)
    {

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $path = $photo->store('work_photos', 'public');

            $workPhoto = WorkPhoto::create([
                'work_id' => $work->id,
                'url' => $path
            ]);


            return response()->json([
                'message' => 'Success',
                'data' => $workPhoto
            ], 201);
        } else{
            return response()->json([
                'message' => 'Not saved',
            ], 201);
        }
    }

    // GET /works/{work}/photos/{photo}
    public function show(Work $work, WorkPhoto $photo)
    {
        if ($photo->work_id != $work->id) {
            return response()->json(['error' => 'Not found'], 404);
        }

        return response()->json($photo);
    }

    public function update(UpdateWorkPhotoRequest $request, Work $work, WorkPhoto $photo)
    {
        if ($photo->work_id != $work->id) {
            return response()->json(['error' => 'Forbidden'], 403);
        }

        $data = $request->validated();

        if ($request->hasFile('photo')) {
            if ($photo->url && Storage::disk('public')->exists($photo->url)) {
                Storage::disk('public')->delete($photo->url);
            }

            $path = $request->file('photo')->store('work_photos', 'public');
            $data['url'] = $path;
        }

        $photo->update($data);

        return response()->json([
            'message' => 'Photo updated successfully',
            'data' => $photo
        ]);
    }




    // DELETE /works/{work}/photos/{photo}
    public function destroy(Work $work, WorkPhoto $photo)
    {
        if ($photo->work_id != $work->id) {
            return response()->json(['error' => 'Forbidden'], 403);
        }

        if (Storage::disk('public')->exists($photo->url)) {
            Storage::disk('public')->delete($photo->url);
        }

        $photo->delete();

        return response()->json(['message' => 'Photo deleted']);
    }
}
