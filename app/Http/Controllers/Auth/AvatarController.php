<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AvatarController extends Controller
{
    public function avatarCreateOrUpdate(Request $request)
    {
        $user = Auth::user();
        if (!$user instanceof User) {
            abort(403, 'Authenticated user is not valid.');
        }

        $request->validate([
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Rasmlarni saqlash
        if ($request->hasFile('avatar')) {
            // Eski rasmni o'chirish
            if ($user->avatar && Storage::exists('public/' . $user->avatar)) {
                Storage::delete('public/' . $user->avatar);
            }

            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $path;
            $user->save();
        }

        return redirect()->back()->with('success', 'Avatar muvaffaqiyatli saqlandi');
    }
}
