<?php

namespace App\Livewire\Backend\Attendance\Student;

use App\Services\Attendance\AttendanceService;
use Livewire\Component;
use Illuminate\Http\Request;

class WeekDatatables extends Component
{
    public function render()
    {
        return view('livewire.backend.attendance.student.week-datatables');
    }

    public function getDataTable(Request $request)
    {
        $dates = [
            'startDate' => $request->input('startDate'),
            'endDate' => $request->input('endDate')
        ];
        $attendanceService = app(AttendanceService::class);
        return $attendanceService->getDatatablesStudentByWeek($dates);
    }

    public function refreshDataTable()
    {
        $this->dispatch('refreshDatatable');
    }
}
