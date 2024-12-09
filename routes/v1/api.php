<?php

use App\Http\Controllers\API\V1\AppointmentController;
use App\Http\Controllers\API\V1\Auth\StaffLoginController;
use App\Http\Controllers\API\V1\CategoryController;
use App\Http\Controllers\API\V1\OfferedServiceController;
use App\Http\Controllers\API\V1\StaffController;
use App\Http\Controllers\API\V1\TenantController;
use App\Http\Controllers\API\V1\TenantUserController;
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
    Route::middleware(['can:staff_route_access'])->prefix('admin')->group(function () {
        Route::apiResource('staff', StaffController::class);
        Route::apiResource('user', UserController::class);
        Route::apiResource('tenant', TenantController::class);
        Route::apiResource('tenant.users', TenantUserController::class);
        Route::apiResource('tenant.categories', CategoryController::class);
        Route::apiResource('tenant.services', OfferedServiceController::class);
        Route::apiResource('appointments', AppointmentController::class);
    });

    Route::middleware(['can:tenant_route_access'])->prefix('tenant')->group(function () {
        Route::apiResource('tenant.users', TenantUserController::class);
        Route::apiResource('tenant.categories', CategoryController::class);
        Route::apiResource('tenant.services', OfferedServiceController::class);
    });

});
