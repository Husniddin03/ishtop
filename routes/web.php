<?php

use App\Http\Controllers\WEB\PageController;
use App\Http\Controllers\WEB\UserController;
use App\Http\Controllers\WEB\WorkController;
use App\Http\Controllers\WEB\WorkerController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'index']);

// Users Routes
Route::resource('users', UserController::class);

// User Connections
Route::post('users/{user}/connections', [UserController::class, 'storeConnection'])->name('users.connections.store');
Route::delete('user-connections/{connection}', [UserController::class, 'destroyConnection'])->name('users.connections.destroy');

// User Locations
Route::post('users/{user}/locations', [UserController::class, 'storeLocation'])->name('users.locations.store');
Route::delete('user-locations/{location}', [UserController::class, 'destroyLocation'])->name('users.locations.destroy');

// Wallet
Route::put('users/{user}/wallet', [UserController::class, 'updateWallet'])->name('users.wallet.update');

// Works Routes
Route::resource('works', WorkController::class);

// Work Connections
Route::post('works/{work}/connections', [WorkController::class, 'storeConnection'])->name('works.connections.store');
Route::delete('work-connections/{connection}', [WorkController::class, 'destroyConnection'])->name('works.connections.destroy');

// Work Locations
Route::post('works/{work}/locations', [WorkController::class, 'storeLocation'])->name('works.locations.store');
Route::delete('work-locations/{location}', [WorkController::class, 'destroyLocation'])->name('works.locations.destroy');

// Work Photos
Route::post('works/{work}/photos', [WorkController::class, 'storePhoto'])->name('works.photos.store');
Route::delete('work-photos/{photo}', [WorkController::class, 'destroyPhoto'])->name('works.photos.destroy');

// Work Videos
Route::post('works/{work}/videos', [WorkController::class, 'storeVideo'])->name('works.videos.store');
Route::delete('work-videos/{video}', [WorkController::class, 'destroyVideo'])->name('works.videos.destroy');

// Workers Routes
Route::resource('workers', WorkerController::class);
Route::resource('pages', PageController::class);
