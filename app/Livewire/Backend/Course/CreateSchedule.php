<?php

namespace App\Livewire\Backend\Course;

use App\Traits\{LivewireMessageEvents, CloseModalTrait};
use Livewire\Component;

class CreateSchedule extends Component
{
    use LivewireMessageEvents, CloseModalTrait;

    public $course, $checkInStart, $checkInEnd, $day, $checkOutStart, $checkOutEnd, $lecturerId, $courseId;

    public function mount($course)
    {
        $this->course = $course;
        $this->courseId = $course->id;
        $this->lecturerId = $course->lecturer_id;
    }

    public function render()
    {
        return view('livewire.backend.course.create-schedule');
    }

    public function resetFields()
    {
        $this->checkInStart = '';
        $this->checkInEnd = '';
        $this->day = '';
        $this->checkOutStart = '';
        $this->checkOutEnd = '';
        $this->lecturerId = '';
    }
}
