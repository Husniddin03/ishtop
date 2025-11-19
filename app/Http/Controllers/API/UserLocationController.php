<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\StoreUserLocationRequest;
use App\Http\Requests\API\UpdateUserLocationRequest;
use App\Models\User;
use App\Models\UserLocation;
use Illuminate\Http\Request;

class UserLocationController extends Controller
{
    // GET /users/{user}/locations
    public function index(User $user)
    {
        $locations = $user->locations()->get();
        return response()->json($locations);
    }

    // POST /users/{user}/locations
    public function store(StoreUserLocationRequest $request, User $user)
    {
        $data = $request->validated();
        $data['user_id'] = $user->id;

        $location = UserLocation::create($data);

        return response()->json($location, 201);
    }

    // GET /users/{user}/locations/{location}
    public function show(User $user, UserLocation $location)
    {
        if ($location->user_id != $user->id) {
            return response()->json(['error' => 'Not found'], 404);
        }

        return response()->json($location);
    }

    // PUT/PATCH /users/{user}/locations/{location}
    public function update(UpdateUserLocationRequest $request, User $user, UserLocation $location)
    {
        if ($location->user_id != $user->id) {
            return response()->json(['error' => 'Forbidden'], 403);
        }

        $location->update($request->validated());

        return response()->json($location);
    }

    // DELETE /users/{user}/locations/{location}
    public function destroy(User $user, UserLocation $location)
    {
        if ($location->user_id != $user->id) {
            return response()->json(['error' => 'Forbidden'], 403);
        }

        $location->delete();

        return response()->json(['message' => 'Location deleted']);
    }
}
