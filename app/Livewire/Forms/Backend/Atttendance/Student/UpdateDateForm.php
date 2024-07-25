<?php

namespace App\Livewire\Forms\Backend\Atttendance\Student;

use Livewire\Attributes\Validate;
use Livewire\Form;

class UpdateDateForm extends Form
{
    /**
     * The properties of a attendances object.
     */
    public $attendanceId, $userId, $checkIn, $checkOut, $attendanceDate, $remarks, $status, $name, $courseName;

    public function setAttendance($attendance)
    {
        $this->attendanceId = $attendance->id;
        $this->userId = $attendance->user_id;
        $this->checkIn = $attendance->check_in ?? "-";
        $this->checkOut = $attendance->check_out ?? "-";
        $this->attendanceDate = date("Y-m-d", strtotime($attendance->attendance_date));
        $this->remarks = $attendance->remarks;
        $this->status = $attendance->status;
        $this->name = $attendance->user->name;
        $this->courseName = $attendance->courseSchedule->course->name;
    }
}
