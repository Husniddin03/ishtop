<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\StoreWalletRequest;
use App\Http\Requests\API\UpdateWalletRequest;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    // GET /users/{user}/wallets
    public function index(User $user)
    {
        $wallet = $user->wallet;
        if (!$wallet) {
            return response()->json(['message' => 'Wallet not found'], 404);
        }
        return response()->json($wallet);
    }

    // POST /users/{user}/wallets
    public function store(StoreWalletRequest $request, User $user)
    {
        $data = $request->validated();
        $data['user_id'] = $user->id;

        $wallet = Wallet::create($data);

        return response()->json($wallet, 201);
    }

    // GET /users/{user}/wallets/{wallet}
    public function show(User $user, Wallet $wallet)
    {
        if ($wallet->user_id != $user->id) {
            return response()->json(['error' => 'Not found'], 404);
        }
        return response()->json($wallet);
    }

    // PUT/PATCH /users/{user}/wallets/{wallet}
    public function update(UpdateWalletRequest $request, User $user, Wallet $wallet)
    {
        if ($wallet->user_id != $user->id) {
            return response()->json(['error' => 'Forbidden'], 403);
        }

        $wallet->update($request->validated());

        return response()->json($wallet);
    }

    // DELETE /users/{user}/wallets/{wallet}
    public function destroy(User $user, Wallet $wallet)
    {
        if ($wallet->user_id != $user->id) {
            return response()->json(['error' => 'Forbidden'], 403);
        }

        $wallet->delete();

        return response()->json(['message' => 'Wallet deleted']);
    }
}
