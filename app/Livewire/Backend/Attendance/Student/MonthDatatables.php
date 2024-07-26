<?php

namespace App\Livewire\Backend\Attendance\Student;

use App\Services\Attendance\AttendanceService;
use Livewire\Component;
use Illuminate\Http\Request;

class MonthDatatables extends Component
{
    public function render()
    {
        return view('livewire.backend.attendance.student.month-datatables');
    }

    public function getDataTable(Request $request)
    {
        $dates = [
            'startDate' => $request->input('startDate'),
            'endDate' => $request->input('endDate')
        ];
        $attendanceService = app(AttendanceService::class);
        return $attendanceService->getDatatablesStudentByMonth($dates);
    }

}
