<?php

use App\Livewire\EmailVerification;
use App\Livewire\ForgotPassword;
use App\Livewire\Login;
use App\Livewire\Register;
use App\Livewire\ResetPassword;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', Login::class)->name('login');
Route::get('/register', Register::class)->name('register');

Route::get('/forgot-password', ForgotPassword::class)->name('password.request');
Route::get('/reset-password/{token}', ResetPassword::class)->name('password.reset');

//Email Verification
Route::prefix('email')->middleware(['auth'])->group(function () {
    Route::get('verify', EmailVerification::class)->name('verification.notice');

    Route::get('verify/{id}/{hash}', [EmailVerification::class, 'verify'])->middleware(['signed'])->name('verification.verify');
});
