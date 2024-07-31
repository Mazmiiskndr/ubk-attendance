<?php

namespace App\Livewire\Backend\Lecture;

use App\Services\Attendance\AttendanceService;
use Livewire\Attributes\On;
use Livewire\Component;
use Illuminate\Http\Request;

class AttendanceDetailDatatables extends Component
{
    public $lecture, $lectureId;

    public function mount($lecture)
    {
        $this->lecture = $lecture;
        $this->lectureId = $lecture->id;
    }

    public function render()
    {
        return view('livewire.backend.lecture.attendance-detail-datatables');
    }

    public function getDataTable(Request $request)
    {
        $attendanceService = app(AttendanceService::class);
        return $attendanceService->getDatatablesLectureByDate($request->input('lecture_id'));
    }

    #[On('requestLectureDateById')]
    public function getAttendance($attendanceId)
    {
        $this->dispatch('deliverAttendanceLectureToEditComponent', $attendanceId);
    }

    #[On(['attendanceLectureUpdated'])]
    public function refreshDataTable()
    {
        $this->dispatch('refreshDatatable');
    }
}
