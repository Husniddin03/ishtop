<?php

use App\Http\Controllers\Auth\AvatarController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Web\ChatController;
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



    Route::get('chat/{id}', [ChatController::class, 'chat'])->name('chat');
    Route::get('allchat', [ChatController::class, 'allchat'])->name('allchat');
    Route::post('chat/send/{id}', [ChatController::class, 'send'])->name('chat.send');
    Route::put('chat/update/{id}', [ChatController::class, 'update'])->name('chat.update');
    Route::delete('chat/destroy/{id}', [ChatController::class, 'destroy'])->name('chat.destroy');
    Route::post('chat/mark-as-read/{id}', [ChatController::class, 'markAsRead'])->name('chat.mark-as-read');

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
