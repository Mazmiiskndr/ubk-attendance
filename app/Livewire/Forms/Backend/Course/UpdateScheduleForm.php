<?php

namespace App\Livewire\Forms\Backend\Course;

use Livewire\Attributes\Validate;
use Livewire\Form;

class UpdateScheduleForm extends Form
{
    /**
     * The properties of a schedules object.
     */
    public $checkInStart, $checkInEnd, $day, $checkOutStart, $checkOutEnd, $courseId, $courseScheduleId;

    public function setSchedule($courseSchedule)
    {
        $this->checkInStart = $courseSchedule->check_in_start;
        $this->checkInEnd = $courseSchedule->check_in_end;
        $this->day = $courseSchedule->day;
        $this->checkOutStart = $courseSchedule->check_out_start;
        $this->checkOutEnd = $courseSchedule->check_out_end;
        $this->courseId = $courseSchedule->course_id;
    }
}
