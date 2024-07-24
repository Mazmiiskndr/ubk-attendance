<?php

use App\Livewire\Backend\{
    Setting\Datatables as SettingDatatables,
    Setting\KelasDatatables as KelasDatatables,
    Student\Datatables as StudentDatatables,
    Lecture\Datatables as LectureDatatables,
    Course\Datatables as CourseDatatables,
    Course\ScheduleDatatables as ScheduleDatatables,
    Attendance\Student\DateDatatables as StudentDateDatatables,
    Attendance\Student\MonthDatatables as StudentMonthDatatables,
};
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Datatables Routes
|--------------------------------------------------------------------------
|
| Here is where you can register datatable routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "datatable" middleware group. Make something great!
|
*/

// Grouping datatable routes
Route::prefix('livewire/backend/')->group(function () {
    // Route for list what i dos page
    // Setting Datatables
    Route::get('setting/getDatatable', [SettingDatatables::class, 'getDatatable'])
        ->name('setting.getDatatable');

    // Kelas Datatables
    Route::get('kelas/getDatatable', [KelasDatatables::class, 'getDatatable'])
        ->name('kelas.getDatatable');

    // Student Datatables
    Route::get('student/getDatatable', [StudentDatatables::class, 'getDatatable'])
        ->name('student.getDatatable');

    // Lecture Datatables
    Route::get('lecture/getDatatable', [LectureDatatables::class, 'getDatatable'])
        ->name('lecture.getDatatable');

    // Course Datatables
    Route::get('course/getDatatable', [CourseDatatables::class, 'getDatatable'])
        ->name('course.getDatatable');

    // Course Schedule Datatables
    Route::get('course-schedules/getDatatable/{courseId?}', [ScheduleDatatables::class, 'getDatatable'])
        ->name('course-schedules.getDatatable');

    // Attendances Student By Date Datatables
    Route::get('attendances/students/date/getDatatable', [StudentDateDatatables::class, 'getDatatable'])
        ->name('attendances.students.date.getDatatable');

    // Attendances Student By Month Datatables
    Route::get('attendances/students/month/getDatatable', [StudentMonthDatatables::class, 'getDatatable'])
        ->name('attendances.students.month.getDatatable');
});
