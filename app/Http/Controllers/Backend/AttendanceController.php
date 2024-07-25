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

    public function showStudentAttendanceByMonth()
    {
        return view('pages.backend.attendances.students.month');
    }

    public function editStudentAttendanceByMonth($id)
    {
        dd("TODO:");
    }

    public function detailStudentAttendanceByMonth($id)
    {
        dd("TODO:");
    }

    // END STUDENT

    // START LECTURE
    public function showLectureAttendanceByDate()
    {
        return view('pages.backend.attendances.lecturers.date');
    }

    public function editLectureAttendanceByDate($id)
    {
        dd("TODO:");
    }

    public function detailLectureAttendanceByDate($id)
    {
        dd("TODO:");
    }

    public function showLectureAttendanceByWeek()
    {
        return view('pages.backend.attendances.lecturers.week');
    }

    public function editLectureAttendanceByWeek($id)
    {
        dd("TODO:");
    }

    public function detailLectureAttendanceByWeek($id)
    {
        dd("TODO:");
    }

    public function showLectureAttendanceByMonth()
    {
        return view('pages.backend.attendances.lecturers.month');
    }

    public function editLectureAttendanceByMonth($id)
    {
        dd("TODO:");
    }

    public function detailLectureAttendanceByMonth($id)
    {
        dd("TODO:");
    }

    // END LECTURE
}
