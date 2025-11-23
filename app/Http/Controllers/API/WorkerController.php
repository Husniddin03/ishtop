<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\StoreWorkerRequest;
use App\Http\Requests\API\UpdateWorkerRequest;
use App\Http\Resources\API\WorkerResource;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $worker = Worker::all();
        return WorkerResource::collection($worker);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWorkerRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::id();
        $worker = Worker::create($data);

        return new WorkerResource($worker);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return new WorkerResource(Worker::find($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWorkerRequest $request, Worker $worker)
    {
        $worker->update($request->validated());
        return new WorkerResource($worker);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Worker $worker)
    {
        $worker->delete();
        return response()->json(['message' => 'Worker deleted successfully.'], 200);
    }
}
