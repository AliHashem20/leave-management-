<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeaveRequestController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return Auth::check() ? redirect()->route('leaveRequests.index') : redirect()->route('auth.login');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::middleware('guest')->controller(AuthController::class)->group(function () {
    Route::get('/register', 'showRegister')->name('auth.register');
    Route::get('/login', 'showLogin')->name('auth.login');
    Route::post('/register', 'register')->name('register');
    Route::post('/login', 'login')->name('login');
});

Route::middleware('auth')->group(function () {
    Route::resource('leaveRequests', LeaveRequestController::class)->except(['show']);
});
