<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\StoreWorkConnectionRequest;
use App\Http\Requests\API\UpdateWorkConnectionRequest;
use App\Models\Work;
use App\Models\WorkConnection;
use Illuminate\Http\Request;

class WorkConnectionController extends Controller
{
    // GET /works/{work}/connections
    public function index(Work $work)
    {
        $conns = $work->connections()->get();
        return response()->json($conns);
    }

    // POST /works/{work}/connections
    public function store(StoreWorkConnectionRequest $request, Work $work)
    {
        $data = $request->validated();
        $data['work_id'] = $work->id;

        $conn = WorkConnection::create($data);

        return response()->json($conn, 201);
    }

    // GET /works/{work}/connections/{connection}
    public function show(Work $work, WorkConnection $connection)
    {
        if ($connection->work_id != $work->id) {
            return response()->json(['error' => 'Not found'], 404);
        }

        return response()->json($connection);
    }

    // PUT/PATCH /works/{work}/connections/{connection}
    public function update(UpdateWorkConnectionRequest $request, Work $work, WorkConnection $connection)
    {
        if ($connection->work_id != $work->id) {
            return response()->json(['error' => 'Forbidden'], 403);
        }

        $connection->update($request->validated());

        return response()->json($connection);
    }

    // DELETE /works/{work}/connections/{connection}
    public function destroy(Work $work, WorkConnection $connection)
    {
        if ($connection->work_id != $work->id) {
            return response()->json(['error' => 'Forbidden'], 403);
        }

        $connection->delete();

        return response()->json(['message' => 'Connection deleted']);
    }
}
