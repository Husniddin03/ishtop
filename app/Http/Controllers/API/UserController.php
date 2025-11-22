<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\StoreUserRequest;
use App\Http\Requests\API\UpdateUserRequest;
use App\Http\Resources\API\UserCollection;
use App\Http\Resources\API\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    public function index()
    {
        $users = User::with(['wallet', 'connections', 'locations', 'works'])->paginate(15);
        return new UserCollection($users);
    }

    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();
        if (isset($data['image'])) {
            $data['image'] = $data['image']->store('users', 'public');
        }
        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);
        $token = $user->createToken('api-token')->plainTextToken;
        return new UserResource($user->load(['wallet', 'connections', 'locations', 'works']));
    }

    public function show(User $user)
    {
        return new UserResource($user->load(['wallet', 'connections', 'locations', 'works']));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->validated();

        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        if ($request->hasFile('image')) {

            if (isset($user->image)) {
                Storage::disk('public')->delete($user->image);
            }

            $data['image'] = $request->file('image')->store('users', 'public');
        } else {
            unset($data['image']);
        }

        $user->update($data);

        return new UserResource(
            $user->fresh()->load(['wallet', 'connections', 'locations', 'works'])
        );
    }



    public function destroy(User $user)
    {

        if (isset($user->image)) {
            Storage::disk('public')->delete($user->image);
        }
        $user->delete();
        return response()->json(['message' => 'User deleted successfully.'], 200);
    }
}
