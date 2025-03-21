<?php

use Illuminate\Support\Facades\Route;
use Modules\MaintenanceHub\Http\Controllers\MaintenanceHubController;
use Modules\MaintenanceHub\Http\Controllers\MaintenanceRequestController;
use Modules\MaintenanceHub\Http\Controllers\TechnicianAssignmentController;
use Modules\MaintenanceHub\Http\Controllers\TechnicianController;

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

    // --- CRUD maintenance-request api endpoints ---
    Route::post("maintenance-request", [MaintenanceRequestController::class, "store"]);
    Route::patch("maintenance-request/{id}", [MaintenanceRequestController::class, "update"]);
    Route::get("maintenance-request/{id?}", [MaintenanceRequestController::class, "show"]);
    Route::delete("maintenance-request/{id}", [MaintenanceRequestController::class, "delete"]);

    // --- CRUD technician api endpoints ---
    Route::post("technician", [TechnicianController::class, "store"]);
    Route::patch("technician/{id}", [TechnicianController::class, "update"]);
    Route::get("technician/{id?}", [TechnicianController::class, "show"]);
    Route::delete("technician/{id}", [TechnicianController::class, "delete"]);

    // --- CRUD technician-assignment api endpoints ---
    Route::post("technician-assignment", [TechnicianAssignmentController::class, "store"]);
    Route::patch("technician-assignment/{id}", [TechnicianAssignmentController::class, "update"]);
    Route::get("technician-assignment/{id?}", [TechnicianAssignmentController::class, "show"]);
    Route::delete("technician-assignment/{id}", [TechnicianAssignmentController::class, "delete"]);

    // --- dashboard summary api endpoint ---
    Route::get("summary/maintenance-request", [MaintenanceHubController::class, "maintenanceRequestsSummary"]);
    Route::get("summary/technician-assignment", [MaintenanceHubController::class, "assignmentsSummary"]);
    Route::get("summary/technician", [MaintenanceHubController::class, "techniciansSummary"]);
});
