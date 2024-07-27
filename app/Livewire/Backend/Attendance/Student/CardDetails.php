<?php

namespace App\Livewire\Backend\Attendance\Student;

use App\Enums\AttendanceStatus;
use Livewire\Component;

class CardDetails extends Component
{
    public $attendance, $statusAttendance = "";

    public function mount($attendance)
    {
        $this->attendance = $attendance;
        $status = AttendanceStatus::from($this->attendance->status);
        $labelClass = match ($status) {
            AttendanceStatus::Hadir => 'bg-success',
            AttendanceStatus::Sakit => 'bg-warning',
            AttendanceStatus::Izin => 'bg-info',
            AttendanceStatus::Terlambat => 'bg-secondary',
            AttendanceStatus::Alpha => 'bg-danger',
        };
        $this->statusAttendance = '<span class="badge ' . $labelClass . '">' . $status->name . '</span>';
    }

    public function render()
    {
        return view('livewire.backend.attendance.student.card-details');
    }
}
