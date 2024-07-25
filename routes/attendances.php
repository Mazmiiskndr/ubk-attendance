<?php

use App\Http\Controllers\{
    Backend\AttendanceController,
};
use Illuminate\Support\Facades\Route;


/*
| Here is where you can register portfolio routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "portfolio" middleware group. Make something great!
|
*/

// Grouping portfolios routes
Route::middleware('auth')->name('backend.')->group(function () {
    // Route for list portfolios page
    Route::get('attendances/students/date', [AttendanceController::class, 'showStudentAttendanceByDate'])->name('attendances.students.date');
    Route::get('attendances/students/date/update/{id}', [AttendanceController::class, 'editStudentAttendanceByDate'])->name('attendances.students.date.edit');
    Route::get('attendances/students/date/detail/{id}', [AttendanceController::class, 'detailStudentAttendanceByDate'])->name('attendances.students.date.show');

    Route::get('attendances/students/week', [AttendanceController::class, 'showStudentAttendanceByWeek'])->name('attendances.students.week');
    Route::get('attendances/students/week/update/{id}', [AttendanceController::class, 'editStudentAttendanceByWeek'])->name('attendances.students.week.edit');
    Route::get('attendances/students/week/detail/{id}', [AttendanceController::class, 'detailStudentAttendanceByWeek'])->name('attendances.students.week.show');

    Route::get('attendances/students/month', [AttendanceController::class, 'showStudentAttendanceByMonth'])->name('attendances.students.month');
    Route::get('attendances/students/month/update/{id}', [AttendanceController::class, 'editStudentAttendanceByMonth'])->name('attendances.students.month.edit');
    Route::get('attendances/students/month/detail/{id}', [AttendanceController::class, 'detailStudentAttendanceByMonth'])->name('attendances.students.month.show');
});
