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

    public function editStudentAttendanceByDate($id)
    {
        dd("TODO:");
    }

    public function detailStudentAttendanceByDate($id)
    {
        dd("TODO:");
    }

    public function showStudentAttendanceByWeek()
    {
        return view('pages.backend.attendances.students.week');
    }

    public function editStudentAttendanceByWeek($id)
    {
        dd("TODO:");
    }

    public function detailStudentAttendanceByWeek($id)
    {
        dd("TODO:");
    }
}
