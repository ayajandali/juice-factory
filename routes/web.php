<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuperEmployeeController;
use App\Http\Controllers\LeaveRequestController;
use App\Http\Controllers\DailyWorkStatusController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    
    Route::post('/super-employee/leave-request', [LeaveRequestController::class, 'store'])
    ->name('super-employee.leave-request');

    Route::get('/dashboards/super-employee-index', [LeaveRequestController::class, 'index'])
        ->name('super-employee.leave-requests');

    Route::get('/super-employee', [DailyWorkStatusController::class, 'index'])
        ->name('super-employee.index');

    Route::post('/super-employee', [DailyWorkStatusController::class, 'store'])
        ->name('super-employee.store');
});





Route::middleware(['auth'])->get('/super-employee/dashboard', [SuperEmployeeController::class, 'index'])->name('super-employee.dashboard');

require __DIR__.'/auth.php';
