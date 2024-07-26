<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    // START STUDENT
    public function showStudentAttendanceByDate()
    {
        return view('pages.backend.attendances.students.date');
    }

    public function showStudentAttendanceByWeek()
    {
        return view('pages.backend.attendances.students.week');
    }

    public function showStudentAttendanceByMonth()
    {
        return view('pages.backend.attendances.students.month');
    }
    // END STUDENT

    // START LECTURE
    public function showLectureAttendanceByDate()
    {
        return view('pages.backend.attendances.lecturers.date');
    }

    public function showLectureAttendanceByWeek()
    {
        return view('pages.backend.attendances.lecturers.week');
    }
    public function showLectureAttendanceByMonth()
    {
        return view('pages.backend.attendances.lecturers.month');
    }
    // END LECTURE
}
