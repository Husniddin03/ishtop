<?php

use App\Http\Controllers\Web\UserContactController;
use App\Http\Controllers\Web\UserController;
use App\Http\Controllers\Web\UserDataController;
use App\Http\Controllers\Web\WalletController;
use App\Http\Controllers\Web\WorkController;
use App\Http\Controllers\Web\WorkerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resources([
        'users' => UserController::class,
        'workers' => WorkerController::class,
        'works' => WorkController::class,
        'user-data' => UserDataController::class,
        'user-wallets' => WalletController::class,
        'user-contacts' => UserContactController::class,
    ]);
});
