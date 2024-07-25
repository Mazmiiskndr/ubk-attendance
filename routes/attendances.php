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
    Route::get('attendances/students/date/update/{id}', [AttendanceController::class, 'editStudentAttendanceByDate'])->name('attendances.students.date.edit');
    Route::get('attendances/students/date/detail/{id}', [AttendanceController::class, 'detailStudentAttendanceByDate'])->name('attendances.students.date.show');

    Route::get('attendances/students/week', [AttendanceController::class, 'showStudentAttendanceByWeek'])->name('attendances.students.week');
    Route::get('attendances/students/week/update/{id}', [AttendanceController::class, 'editStudentAttendanceByWeek'])->name('attendances.students.week.edit');
    Route::get('attendances/students/week/detail/{id}', [AttendanceController::class, 'detailStudentAttendanceByWeek'])->name('attendances.students.week.show');

    Route::get('attendances/students/month', [AttendanceController::class, 'showStudentAttendanceByMonth'])->name('attendances.students.month');
    Route::get('attendances/students/month/update/{id}', [AttendanceController::class, 'editStudentAttendanceByMonth'])->name('attendances.students.month.edit');
    Route::get('attendances/students/month/detail/{id}', [AttendanceController::class, 'detailStudentAttendanceByMonth'])->name('attendances.students.month.show');

    // Route for list attendance Lecture page
    Route::get('attendances/lecturers/date', [AttendanceController::class, 'showLectureAttendanceByDate'])->name('attendances.lecturers.date');
    Route::get('attendances/lecturers/date/update/{id}', [AttendanceController::class, 'editLectureAttendanceByDate'])->name('attendances.lecturers.date.edit');
    Route::get('attendances/lecturers/date/detail/{id}', [AttendanceController::class, 'detailLectureAttendanceByDate'])->name('attendances.lecturers.date.show');

    Route::get('attendances/lecturers/week', [AttendanceController::class, 'showLectureAttendanceByWeek'])->name('attendances.lecturers.week');
    Route::get('attendances/lecturers/week/update/{id}', [AttendanceController::class, 'editLectureAttendanceByWeek'])->name('attendances.lecturers.week.edit');
    Route::get('attendances/lecturers/week/detail/{id}', [AttendanceController::class, 'detailLectureAttendanceByWeek'])->name('attendances.lecturers.week.show');

    Route::get('attendances/lecturers/month', [AttendanceController::class, 'showLectureAttendanceByMonth'])->name('attendances.lecturers.month');
    Route::get('attendances/lecturers/month/update/{id}', [AttendanceController::class, 'editLectureAttendanceByMonth'])->name('attendances.lecturers.month.edit');
    Route::get('attendances/lecturers/month/detail/{id}', [AttendanceController::class, 'detailLectureAttendanceByMonth'])->name('attendances.lecturers.month.show');
});
