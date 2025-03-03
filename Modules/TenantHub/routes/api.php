<?php

use Illuminate\Support\Facades\Route;
use Modules\TenantHub\Http\Controllers\LeaseController;
use Modules\TenantHub\Http\Controllers\TenantController;
use Modules\TenantHub\Http\Controllers\TenantHubController;

/*
 *--------------------------------------------------------------------------
 * API Routes
 *--------------------------------------------------------------------------
 *
 * Here is where you can register API routes for your application. These
 * routes are loaded by the RouteServiceProvider within a group which
 * is assigned the "api" middleware group. Enjoy building your API!
 *
 */

Route::middleware("auth:sanctum")->prefix("v1")->group(function () {

    // --- CRUD tenant api endpoints ---
    Route::post("tenant", [TenantController::class, "store"]);
    Route::patch("tenant/{id}", [TenantController::class, "update"]);
    Route::get("tenant/{id?}", [TenantController::class, "show"]);
    Route::delete("tenant/{id}", [TenantController::class, "delete"]);

    // --- CRUD lease api endpoints ---
    Route::post("lease", [LeaseController::class, "store"]);
    Route::patch("lease", [LeaseController::class, "update"]);
    Route::get("lease", [LeaseController::class, "show"]);
    Route::delete("lease", [LeaseController::class, "delete"]);

    // --- dashboard summary api endpoint ---
    Route::get("summary/tenant", [TenantHubController::class, "summary"]);
});
