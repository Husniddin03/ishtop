<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisterController extends Controller
{

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // $code = rand(100000, 999999);

        // // Session'ga saqlash
        // session([
        //     'email_werifiy_code' => $code,
        //     'register_data' => $request->only('name', 'email', 'password')
        // ]);

        // Mail::raw("Sizning tasdiqlash kodingiz: $code", function ($message) use ($request) {
        //     $message->to($request->email)->subject('Email tasdiqlash kodi');
        // });

        // return redirect()->route('verify.code.form');
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->wallet()->create(['balanse' => 100]);

        event(new Registered($user));
        Auth::login($user);

        return redirect()->route('dashboard');
    }

    public function verifyCode(Request $request)
    {
        $request->validate([
            'code' => 'required|string|digits:6',
        ]);

        $data = session('register_data');
        $storedCode = session('email_werifiy_code');

        if (!$data || !$storedCode) {
            return redirect()->route('register')->withErrors('Sessiya tugagan, qaytadan urinib ko‘ring.');
        }

        if ($storedCode != $request->code) {
            return back()->withErrors('Kod noto‘g‘ri.');
        }

        // User yaratish
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        event(new Registered($user));
        Auth::login($user);

        // Session'larni tozalash
        session()->forget(['register_data', 'email_werifiy_code']);

        return redirect()->route('dashboard');
    }
}
