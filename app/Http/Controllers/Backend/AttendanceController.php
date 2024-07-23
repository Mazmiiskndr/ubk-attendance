<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function showStudentAttendanceByDate()
    {
        return view('pages.backend.attendances.students.date');
    }

    public function editStudentAttendanceByDate()
    {
        dd("TODO:");
    }

    public function detailStudentAttendanceByDate()
    {
        dd("TODO:");
    }

    public function showStudentAttendanceByMonth()
    {
        return view('pages.backend.attendances.students.month');
    }

    public function editStudentAttendanceByMonth()
    {
        dd("TODO:");
    }

    public function detailStudentAttendanceByMonth()
    {
        dd("TODO:");
    }
}
