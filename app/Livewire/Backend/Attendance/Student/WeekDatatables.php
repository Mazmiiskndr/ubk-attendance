<?php

namespace App\Livewire\Backend\Attendance\Student;

use App\Services\Attendance\AttendanceService;
use Livewire\Component;

class WeekDatatables extends Component
{
    public function render()
    {
        return view('livewire.backend.attendance.student.week-datatables');
    }

    public function getDataTable(AttendanceService $attendanceService)
    {
        return $attendanceService->getDatatablesByWeek();
    }
}