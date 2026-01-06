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

Route::get('/', function () {
    return view('dashboard');
});



Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('work/chat/{id}', [WorkController::class, 'chat'])->name('work.chat');
    Route::get('work/allchat', [WorkController::class, 'allchat'])->name('work.allchat');

    Route::resources([
        'users' => UserController::class,
        'workers' => WorkerController::class,
        'works' => WorkController::class,
        'user-wallets' => WalletController::class,
        'user-contacts' => UserContactController::class,
    ]);

    Route::get('profile/myads', [UserDataController::class, 'myads'])->name('profile.myads');

    Route::post('auth/avatar/update', [AvatarController::class, 'avatarCreateOrUpdate'])->name('auth.avatar.update');
});

Route::post('register', [RegisterController::class, 'store'])->name('register.store');


Route::get('/verify-code', function () {
    return view('verify.code');
})->name('verify.code.form');

Route::post('/verify-code', [RegisterController::class, 'verifyCode'])->name('verify.code');
