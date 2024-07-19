<?php

use Rono\AdminPanel\Controllers\AdminAuthController;
use Rono\AdminPanel\Controllers\BookingsController;
use Rono\AdminPanel\Controllers\VehiclesController;

Route::get('backend/rono/adminpanel/auth/login', [AdminAuthController::class, 'login']);
Route::post('backend/rono/adminpanel/auth/authenticate', [AdminAuthController::class, 'authenticate']);
Route::get('backend/rono/adminpanel/dashboard', [AdminAuthController::class, 'dashboard']);

// Routes for bookings
Route::get('backend/rono/adminpanel/bookings', [BookingsController::class, 'index']);
Route::post('backend/rono/adminpanel/bookings/update-status/{id}', [BookingsController::class, 'updateStatus']);
Route::get('backend/rono/adminpanel/bookings/export', [BookingsController::class, 'export']);

// Routes for vehicles
Route::get('backend/rono/adminpanel/vehicles', [VehiclesController::class, 'index']);
Route::get('backend/rono/adminpanel/vehicles/create', [VehiclesController::class, 'create']);
Route::post('backend/rono/adminpanel/vehicles/store', [VehiclesController::class, 'store']);
Route::get('backend/rono/adminpanel/vehicles/edit/{id}', [VehiclesController::class, 'edit']);
Route::post('backend/rono/adminpanel/vehicles/update/{id}', [VehiclesController::class, 'update']);
Route::post('backend/rono/adminpanel/vehicles/destroy/{id}', [VehiclesController::class, 'destroy']);
