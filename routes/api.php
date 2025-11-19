<?php

use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\UserConnectionController;
use App\Http\Controllers\API\UserLocationController;
use App\Http\Controllers\API\WalletController;
use App\Http\Controllers\API\WorkController;
use App\Http\Controllers\API\WorkConnectionController;
use App\Http\Controllers\API\WorkLocationController;
use App\Http\Controllers\API\WorkPhotoController;
use App\Http\Controllers\API\WorkVideoController;
use Illuminate\Support\Facades\Route;

Route::apiResource('users', UserController::class);
Route::apiResource('works', WorkController::class);
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('users.connections', UserConnectionController::class);
    Route::apiResource('users.locations', UserLocationController::class);
    Route::apiResource('users.wallets', WalletController::class);

    Route::apiResource('works.connections', WorkConnectionController::class);
    Route::apiResource('works.locations', WorkLocationController::class);
    Route::apiResource('works.photos', WorkPhotoController::class);
    Route::apiResource('works.videos', WorkVideoController::class);
});
