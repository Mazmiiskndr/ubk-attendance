<?php

namespace App\Livewire\Backend\Attendance\Student;

use App\Services\Attendance\AttendanceService;
use Livewire\Attributes\On;
use Illuminate\Http\Request;
use Livewire\Component;

class DateDatatables extends Component
{
    public function render()
    {
        return view('livewire.backend.attendance.student.date-datatables');
    }

    public function getDataTable(Request $request)
    {
        $attendanceService = app(AttendanceService::class);
        return $attendanceService->getDatatablesStudentByDate($request->input('date'));
    }

    #[On('requestStudentDateById')]
    public function getAttendance($attendanceId)
    {
        $this->dispatch('deliverAttendanceToEditComponent', $attendanceId);
    }

    #[On(['attendanceUpdated'])]
    public function refreshDataTable()
    {
        $this->dispatch('refreshDatatable');
    }
}
