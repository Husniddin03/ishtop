<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\StoreWorkRequest;
use App\Http\Requests\API\UpdateWorkRequest;
use App\Http\Resources\API\WorkCollection;
use App\Http\Resources\API\WorkResource;
use App\Models\Work;
use Illuminate\Http\Request;

class WorkController extends Controller
{
    public function index()
    {
        $works = Work::with(['connections','locations','photos','videos'])->paginate(15);
        return new WorkCollection($works);
    }

    public function store(StoreWorkRequest $request)
    {
        $work = Work::create($request->validated());
        return new WorkResource($work->load(['connections','locations','photos','videos']));
    }

    public function show(Work $work)
    {
        return new WorkResource($work->load(['connections','locations','photos','videos']));
    }

    public function update(UpdateWorkRequest $request, Work $work)
    {
        $work->update($request->validated());
        return new WorkResource($work->fresh()->load(['connections','locations','photos','videos']));
    }

    public function destroy(Work $work)
    {
        $work->delete();
        return response()->json(['message' => 'Work deleted successfully.'], 200);
    }
}
