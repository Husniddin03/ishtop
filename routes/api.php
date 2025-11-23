<?php

use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\UserConnectionController;
use App\Http\Controllers\API\UserLocationController;
use App\Http\Controllers\API\WalletController;
use App\Http\Controllers\API\WorkController;
use App\Http\Controllers\API\WorkConnectionController;
use App\Http\Controllers\API\WorkerController;
use App\Http\Controllers\API\WorkLocationController;
use App\Http\Controllers\API\WorkPhotoController;
use App\Http\Controllers\API\WorkVideoController;
use Illuminate\Support\Facades\Route;

Route::post('login', [LoginController::class, 'login'])->name('api.login');
Route::apiResource('users', UserController::class)->names('api.users');
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('works', WorkController::class)->names('api.works');
    Route::apiResource('workers', WorkerController::class)->names('api.workers');
    Route::apiResource('users.connections', UserConnectionController::class)->names('api.users.connections');
    Route::apiResource('users.locations', UserLocationController::class)->names('api.users.locations');
    Route::apiResource('users.wallets', WalletController::class)->names('api.users.wallets');
    Route::apiResource('works.connections', WorkConnectionController::class)->names('api.works.connections');
    Route::apiResource('works.locations', WorkLocationController::class)->names('api.works.locations');
    Route::apiResource('works.photos', WorkPhotoController::class)->names('api.works.photos');
    Route::apiResource('works.videos', WorkVideoController::class)->names('api.works.videos');
});
