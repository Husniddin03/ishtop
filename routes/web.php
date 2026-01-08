<?php

use App\Http\Controllers\Auth\AvatarController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Web\UserContactController;
use App\Http\Controllers\Web\UserController;
use App\Http\Controllers\Web\UserDataController;
use App\Http\Controllers\Web\WalletController;
use App\Http\Controllers\Web\WorkController;
use App\Http\Controllers\Web\WorkerController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {

    Route::get('/', function () {
        return view('dashboard');
    });

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('chat/{id}', [UserController::class, 'chat'])->name('chat');
    Route::get('allchat', [UserController::class, 'allchat'])->name('allchat');

    Route::resources([
        'users' => UserController::class,
        'workers' => WorkerController::class,
        'works' => WorkController::class,
        'user-wallets' => WalletController::class,
        'user-contacts' => UserContactController::class,
    ]);

    Route::get('profile/myads', [UserDataController::class, 'myads'])->name('profile.myads');
    Route::get('users/profile/{id}', [UserDataController::class, 'show'])->name('users.profile');

    Route::post('auth/avatar/update', [AvatarController::class, 'avatarCreateOrUpdate'])->name('auth.avatar.update');
});

Route::post('register', [RegisterController::class, 'store'])->name('register.store');


Route::get('/verify-code', function () {
    return view('verify.code');
})->name('verify.code.form');

Route::post('/verify-code', [RegisterController::class, 'verifyCode'])->name('verify.code');
