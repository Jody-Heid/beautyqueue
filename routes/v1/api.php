<?php

use App\Http\Controllers\API\V1\AdminController;
use App\Http\Controllers\API\V1\AppointmentController;
use App\Http\Controllers\API\V1\AppointmentStatusController;
use App\Http\Controllers\API\V1\Auth\LoginController;
use App\Http\Controllers\API\V1\Auth\RegisterController;
use App\Http\Controllers\API\V1\CustomerAppointmentController;
use App\Http\Controllers\API\V1\CustomerController;
use App\Http\Controllers\API\V1\HairstylistController;
use App\Http\Controllers\API\V1\OfferedServiceController;
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
    Route::post('login', [LoginController::class, 'authentication']);
    Route::post('register/customer', [RegisterController::class, 'register']);
});

Route::middleware('auth:sanctum')->group(function () {

    Route::prefix('admin')->group(function () {
        Route::apiResource('customers', CustomerController::class)->except(['create', 'store', 'edit', 'update']);
        Route::apiResource('admins', AdminController::class);
        Route::apiResource('hairstylists', HairstylistController::class);
        Route::apiResource('users', UserController::class);
        Route::apiResource('appointments', AppointmentController::class);
        Route::put('appointments/{appointment}/change-status', [AppointmentStatusController::class, 'changeAppointmentStatus']);
    });

    Route::prefix('staff')->group(function () {
        Route::prefix('hairstylist')->group(function () {
            Route::apiResource('hairstylists', HairstylistController::class)->only(['show', 'update']);
            Route::apiResource('appointments', AppointmentController::class)->except(['delete']);
            Route::put('appointments/{appointment}/change-status', [AppointmentStatusController::class, 'changeAppointmentStatus']);
        });
    });

    Route::prefix('customer')->group(function () {
        Route::apiResource('customers', CustomerController::class)->except(['delete', 'create', 'store']);
        Route::apiResource('appointments', CustomerAppointmentController::class)->except(['delete']);
        Route::put('appointments/{appointment}/change-status', [AppointmentStatusController::class, 'changeAppointmentStatus']);
    });

    Route::apiResource('services', OfferedServiceController::class);
});
