<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserConnection;
use App\Http\Requests\API\StoreUserConnectionRequest;
use App\Http\Requests\API\UpdateUserConnectionRequest;

class UserConnectionController extends Controller
{
    // GET /users/{user}/connections
    public function index(User $user)
    {
        return response()->json($user->connections);
    }

    // POST /users/{user}/connections
    public function store(StoreUserConnectionRequest $request, User $user)
    {
        $data = $request->validated();
        $data['user_id'] = $user->id;

        $connection = UserConnection::create($data);

        return response()->json($connection, 201);
    }

    // GET /users/{user}/connections/{connection}
    public function show(User $user, UserConnection $connection)
    {
        if ($connection->user_id != $user->id) {
            return response()->json(['error' => 'Not owner'], 403);
        }

        return response()->json($connection);
    }

    // PUT/PATCH /users/{user}/connections/{connection}
    public function update(UpdateUserConnectionRequest $request, User $user, UserConnection $connection)
    {
        if ($connection->user_id != $user->id) {
            return response()->json(['error' => 'Not owner'], 403);
        }

        $connection->update($request->validated());

        return response()->json($connection);
    }

    // DELETE /users/{user}/connections/{connection}
    public function destroy(User $user, UserConnection $connection)
    {
        if ($connection->user_id != $user->id) {
            return response()->json(['error' => 'Not owner'], 403);
        }

        $connection->delete();

        return response()->json(['message' => 'Deleted']);
    }
}
