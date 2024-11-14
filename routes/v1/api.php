<?php

use App\Http\Controllers\API\V1\Auth\StaffLoginController;
use App\Http\Controllers\API\V1\Auth\UserLoginController;
use App\Http\Controllers\API\V1\StaffController;
use App\Http\Controllers\API\V1\TenantController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('auth')->group(function () {
    Route::post('/staff/login', [StaffLoginController::class, 'authentication']);
    Route::post('login', [UserLoginController::class, 'authentication']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('staff')->group(function () {
        Route::prefix('admin')->group(function () {
            Route::apiResource('tenant', TenantController::class);
            Route::apiResource('staff', StaffController::class);
        });
    });
});
