<?php

namespace App\Livewire\Backend\Attendance\Lecture;

use App\Services\Attendance\AttendanceService;
use Livewire\Attributes\On;
use Livewire\Component;

class DateDatatables extends Component
{
    public function render()
    {
        return view('livewire.backend.attendance.lecture.date-datatables');
    }

    #[On('requestLectureDateById')]
    public function getAttendance($attendanceId)
    {
        $this->dispatch('deliverAttendanceLectureToEditComponent', $attendanceId);
    }


    public function getDataTable(AttendanceService $attendanceService)
    {
        return $attendanceService->getDatatablesLectureByDate();
    }

    #[On(['attendanceLectureUpdated'])]
    public function refreshDataTable()
    {
        $this->dispatch('refreshDatatable');
    }
}
