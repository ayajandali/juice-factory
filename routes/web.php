<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuperEmployeeController;
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
});

/*Route::middleware(['auth'])->group(function () {
    Route::get('/super-employee/home', [SuperEmployeeController::class, 'index'])->name('super_employee.home');
    Route::put('/super-employee/update-email', [SuperEmployeeController::class, 'updateEmail'])->name('super_employee.updateEmail');
    Route::put('/super-employee/update-password', [SuperEmployeeController::class, 'updatePassword'])->name('super_employee.updatePassword');
});*/

Route::middleware(['auth'])->get('/super-employee/dashboard', [SuperEmployeeController::class, 'index'])->name('super-employee.dashboard');

require __DIR__.'/auth.php';
