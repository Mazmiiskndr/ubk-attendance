<?php

namespace App\Livewire\Backend\Course;

use App\Livewire\Forms\Backend\Course\CreateScheduleForm;
use App\Traits\{LivewireMessageEvents, CloseModalTrait};
use Livewire\Component;

class CreateSchedule extends Component
{
    use LivewireMessageEvents, CloseModalTrait;

    public $course, $lecturerId, $courseId;

    /**
     * The CreateScheduleForm instance associated with this object.
     * @var CreateScheduleForm
     */
    public CreateScheduleForm $form;

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

    public function storeNewSchedule()
    {
        dd('TODO: Store new schedule');
    }

    public function resetFields()
    {
        $this->form->checkInStart = '';
        $this->form->checkInEnd = '';
        $this->form->day = '';
        $this->form->checkOutStart = '';
        $this->form->checkOutEnd = '';
    }
}
