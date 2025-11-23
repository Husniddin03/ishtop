<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserConnection;
use App\Models\UserLocation;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    // Users
    public function index()
    {
        $users = User::with(['connections', 'locations', 'wallet'])->paginate(15);
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'role' => 'nullable|string',
            'phone' => 'nullable|string',
            'birthday' => 'nullable|date',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('users', 'public');
        }

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        // Wallet yaratish
        Wallet::create([
            'user_id' => $user->id,
            'balance' => 0
        ]);

        return redirect()->route('users.index')->with('success', 'Foydalanuvchi muvaffaqiyatli yaratildi!');
    }

    public function show(User $user)
    {
        $user->load(['connections', 'locations', 'wallet', 'works', 'workers']);
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8',
            'role' => 'nullable|string',
            'phone' => 'nullable|string',
            'birthday' => 'nullable|date',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($user->image) {
                Storage::disk('public')->delete($user->image);
            }
            $validated['image'] = $request->file('image')->store('users', 'public');
        }

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('users.show', $user)->with('success', 'Foydalanuvchi yangilandi!');
    }

    public function destroy(User $user)
    {
        if ($user->image) {
            Storage::disk('public')->delete($user->image);
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'Foydalanuvchi o\'chirildi!');
    }

    // User Connections
    public function storeConnection(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'nullable|url',
        ]);

        $user->connections()->create($validated);

        return redirect()->back()->with('success', 'Aloqa qo\'shildi!');
    }

    public function destroyConnection(UserConnection $connection)
    {
        $connection->delete();
        return redirect()->back()->with('success', 'Aloqa o\'chirildi!');
    }

    // User Locations
    public function storeLocation(Request $request, User $user)
    {
        $validated = $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $user->locations()->create($validated);

        return redirect()->back()->with('success', 'Manzil qo\'shildi!');
    }

    public function destroyLocation(UserLocation $location)
    {
        $location->delete();
        return redirect()->back()->with('success', 'Manzil o\'chirildi!');
    }

    // Wallet
    public function updateWallet(Request $request, User $user)
    {
        $validated = $request->validate([
            'balance' => 'required|integer|min:0',
        ]);

        $user->wallet()->updateOrCreate(
            ['user_id' => $user->id],
            ['balance' => $validated['balance']]
        );

        return redirect()->back()->with('success', 'Hamyon yangilandi!');
    }
}
