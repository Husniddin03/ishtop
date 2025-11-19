<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\StoreWorkLocationRequest;
use App\Http\Requests\API\UpdateWorkLocationRequest;
use App\Models\Work;
use App\Models\WorkLocation;
use Illuminate\Http\Request;

class WorkLocationController extends Controller
{
    // GET /works/{work}/locations
    public function index(Work $work)
    {
        $locations = $work->locations()->get();
        return response()->json($locations);
    }

    // POST /works/{work}/locations
    public function store(StoreWorkLocationRequest $request, Work $work)
    {
        $data = $request->validated();
        $data['work_id'] = $work->id;

        $loc = WorkLocation::create($data);

        return response()->json($loc, 201);
    }

    // GET /works/{work}/locations/{location}
    public function show(Work $work, WorkLocation $location)
    {
        if ($location->work_id != $work->id) {
            return response()->json(['error' => 'Not found'], 404);
        }

        return response()->json($location);
    }

    // PUT/PATCH /works/{work}/locations/{location}
    public function update(UpdateWorkLocationRequest $request, Work $work, WorkLocation $location)
    {
        if ($location->work_id != $work->id) {
            return response()->json(['error' => 'Forbidden'], 403);
        }

        $location->update($request->validated());

        return response()->json($location);
    }

    // DELETE /works/{work}/locations/{location}
    public function destroy(Work $work, WorkLocation $location)
    {
        if ($location->work_id != $work->id) {
            return response()->json(['error' => 'Forbidden'], 403);
        }

        $location->delete();

        return response()->json(['message' => 'Location deleted']);
    }
}
