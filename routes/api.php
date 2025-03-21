<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    /* user auth routes */
    Route::post('auth/register', [AuthController::class, 'register'])->name('auth/register');
    Route::post('auth/login', [AuthController::class, 'login'])->name('auth/login');
});

Route::middleware('auth:sanctum')->prefix('v1')->group(function () {
    /* user logout */
    Route::get('auth/logout', [AuthController::class, 'logout'])->name('auth/logout');
});
