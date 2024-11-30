<?php

use App\Http\Controllers\API\V1\Auth\CustomerLoginController;
use App\Http\Controllers\API\V1\Auth\CustomerRegistrationController;
use App\Http\Controllers\API\V1\Auth\StaffLoginController;
use App\Http\Controllers\API\V1\StaffController;
use App\Http\Controllers\API\V1\TenantController;
use App\Http\Controllers\API\V1\UserController;
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
    Route::post('staff/login', [StaffLoginController::class, 'login']);
});

Route::middleware('auth:sanctum')->group(function () {
        Route::prefix('admin')->group(function () {
            Route::apiResource('staff', StaffController::class);
            Route::apiResource('tenant', TenantController::class);
    });
});
