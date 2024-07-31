<?php

use App\Livewire\Backend\{
    Setting\Datatables as SettingDatatables,
    Setting\KelasDatatables as KelasDatatables,
    Student\Datatables as StudentDatatables,
    Lecture\Datatables as LectureDatatables,
    Course\Datatables as CourseDatatables,
    Course\ScheduleDatatables as ScheduleDatatables,
    Course\StudentCourseScheduleDatatables as StudentCourseScheduleDatatables,
    Course\ShowStudentCourseScheduleDatatables as ShowStudentCourseScheduleDatatables,
    Attendance\Student\DateDatatables as StudentDateDatatables,
    Attendance\Student\MonthDatatables as StudentMonthDatatables,
    Attendance\Student\WeekDatatables as StudentWeekDatatables,
    Attendance\Lecture\DateDatatables as LectureDateDatatables,
    Attendance\Lecture\MonthDatatables as LectureMonthDatatables,
    Attendance\Lecture\WeekDatatables as LectureWeekDatatables,
    Student\AttendanceDetailDatatables as AttendanceStudentDetailDatatables,
    Lecture\AttendanceDetailDatatables as AttendanceLectureDetailDatatables,
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

    // Student Course Schedule Datatables
    Route::get('student-course-schedules/getDatatable', [StudentCourseScheduleDatatables::class, 'getDatatable'])
        ->name('student-course-schedules.getDatatable');

    // Course Schedule Datatables
    Route::get('course-schedules/getDatatable/{courseId?}', [ScheduleDatatables::class, 'getDatatable'])
        ->name('course-schedules.getDatatable');

    // Course Schedule Datatables
    Route::get('show-student-course-schedules/getDatatable/{courseId?}', [ShowStudentCourseScheduleDatatables::class, 'getDatatable'])
        ->name('show-student-course-schedules.getDatatable');

    // Attendances Student By Date Datatables
    Route::get('attendances/students/date/getDatatable', [StudentDateDatatables::class, 'getDatatable'])
        ->name('attendances.students.date.getDatatable');

    // Attendances Student By Month Datatables
    Route::get('attendances/students/month/getDatatable', [StudentMonthDatatables::class, 'getDatatable'])
        ->name('attendances.students.month.getDatatable');

    // Attendances Student By Week Datatables
    Route::get('attendances/students/week/getDatatable', [StudentWeekDatatables::class, 'getDatatable'])
        ->name('attendances.students.week.getDatatable');

    // Attendances Lecture By Date Datatables
    Route::get('attendances/lecturers/date/getDatatable', [LectureDateDatatables::class, 'getDatatable'])
        ->name('attendances.lecturers.date.getDatatable');

    // Attendances Lecture By Month Datatables
    Route::get('attendances/lecturers/month/getDatatable', [LectureMonthDatatables::class, 'getDatatable'])
        ->name('attendances.lecturers.month.getDatatable');

    // Attendances Lecture By Week Datatables
    Route::get('attendances/lecturers/week/getDatatable', [LectureWeekDatatables::class, 'getDatatable'])
        ->name('attendances.lecturers.week.getDatatable');

    // Attendances Student Details By Date Datatables
    Route::get('attendances/students/detail/date/getDatatable', [AttendanceStudentDetailDatatables::class, 'getDatatable'])
        ->name('attendances.students.detail.date.getDatatable');

    // Attendances Lecture Details By Date Datatables
    Route::get('attendances/lecturers/detail/date/getDatatable', [AttendanceLectureDetailDatatables::class, 'getDatatable'])
        ->name('attendances.lecturers.detail.date.getDatatable');
});
