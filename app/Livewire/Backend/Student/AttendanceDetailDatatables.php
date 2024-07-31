<?php

namespace App\Livewire\Backend\Student;

use App\Services\Attendance\AttendanceService;
use Livewire\Component;
use Illuminate\Http\Request;

class AttendanceDetailDatatables extends Component
{
    public $student, $studentId;

    public function mount($student)
    {
        $this->student = $student;
        $this->studentId = $student->id;
    }

    public function render()
    {
        return view('livewire.backend.student.attendance-detail-datatables');
    }

    public function getDataTable(Request $request)
    {
        $attendanceService = app(AttendanceService::class);
        return $attendanceService->getDatatablesStudentByDate($request->input('date'), $request->input('student_id'));
    }
}
