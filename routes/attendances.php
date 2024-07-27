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

// Grouping Attendance routes
Route::middleware('auth')->name('backend.')->group(function () {
    // Route for list attendance Student page
    Route::get('attendances/students/date', [AttendanceController::class, 'showStudentAttendanceByDate'])->name('attendances.students.date');
    Route::get('student/detail/{id}', [AttendanceController::class, 'showStudentAttendanceByDateDetail'])->name('attendances.students.date.show');


    Route::get('attendances/students/week', [AttendanceController::class, 'showStudentAttendanceByWeek'])->name('attendances.students.week');

    Route::get('attendances/students/month', [AttendanceController::class, 'showStudentAttendanceByMonth'])->name('attendances.students.month');

    // Route for list attendance Lecture page
    Route::get('attendances/lecturers/date', [AttendanceController::class, 'showLectureAttendanceByDate'])->name('attendances.lecturers.date');

    Route::get('attendances/lecturers/week', [AttendanceController::class, 'showLectureAttendanceByWeek'])->name('attendances.lecturers.week');

    Route::get('attendances/lecturers/month', [AttendanceController::class, 'showLectureAttendanceByMonth'])->name('attendances.lecturers.month');
});
