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
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('auth')->group(function () {
    Route::get('login', [LoginController::class, 'authentication']);
})->name('login');

Route::post('register/user', [RegisterController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('admin')->middleware('admin')->group(function () {
        Route::apiResource('customers', CustomerController::class)->except(['create', 'store', 'edit', 'update']);
        Route::apiResource('admins', AdminController::class);
        Route::apiResource('hairstylists', HairstylistController::class);
        Route::apiResource('users', UserController::class);
        Route::apiResource('services', OfferedServiceController::class);
        Route::apiResource('appointments', AppointmentController::class);
        Route::put('appointments/{appointment}/change-status', [AppointmentStatusController::class, 'changeAppointmentStatus']);
    });

    Route::prefix('hairstylist')->middleware('hairstylist')->group(function () {
        Route::apiResource('hairstylists', HairstylistController::class)->only(['show', 'update']);
        Route::apiResource('services', OfferedServiceController::class)->only(['index', 'show']);
        Route::apiResource('appointments', AppointmentController::class)->except(['delete']);
        Route::put('appointments/{appointment}/change-status', [AppointmentStatusController::class, 'changeAppointmentStatus']);
    });

    Route::prefix('customer')->middleware('customer')->group(function () {
        Route::apiResource('customers', CustomerController::class)->except(['delete', 'create', 'store']);
        Route::apiResource('services', OfferedServiceController::class)->only(['index', 'show']);
        Route::apiResource('appointments', CustomerAppointmentController::class)->except(['delete']);
        Route::put('appointments/{appointment}/change-status', [AppointmentStatusController::class, 'changeAppointmentStatus']);
    });
});
