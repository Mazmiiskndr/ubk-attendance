<?php

use App\Http\Controllers\{
    Backend\UserController,
};
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Portfolios Routes
|--------------------------------------------------------------------------
|
| Here is where you can register portfolio routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "portfolio" middleware group. Make something great!
|
*/

// Grouping portfolios routes
Route::middleware('auth')->prefix('users')->name('backend.')->group(function () {
    // Route for list portfolios page
    Route::get('students', [UserController::class, 'students'])->name('students.index');
    Route::get('students/create', [UserController::class, 'create'])->name('students.create');
    Route::get('student/detail/{id}', [UserController::class, 'showStudent'])->name('student.show');
    Route::get('student/update/{id}', [UserController::class, 'editStudent'])->name('student.edit');
    Route::get('lecturers', [UserController::class, 'lecturers'])->name('lecturers.index');
});
