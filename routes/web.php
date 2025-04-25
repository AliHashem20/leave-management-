<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeaveRequestController;

Route::middleware('auth')->group(function () {
    Route::resource('leaveRequests', LeaveRequestController::class);
});