<?php

namespace App\Livewire\Backend\Course;

use App\Livewire\Forms\Backend\Course\CreateScheduleForm;
use App\Services\Course\CourseService;
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

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function mount($course)
    {
        $this->course = $course;
        $this->courseId = $course->id;
        $this->lecturerId = $course->lecturer_id;
        $this->form->courseId = $this->courseId;
    }

    public function render()
    {
        return view('livewire.backend.course.create-schedule');
    }

    /**
     * Store a new user.
     * @param CourseService $courseService
     * @return void
     */
    public function storeNewSchedule(CourseService $courseService)
    {
        $schedule = $this->form->storeOrUpdate($courseService);
        // Check if $schedule contains valid data or not.
        if ($schedule) {
            // Let other components know that a schedule was created

            // Notify the frontend of success
            $this->dispatch('show-toast', ['type' => 'success', 'message' => 'Jadwal Mata Kuliah berhasil ditambahkan!']);
            // Let other components know that a setting was updated
            $this->dispatch('scheduleCreated', $schedule);
        } else {
            // Notify the frontend of failure
            $this->dispatchErrorEvent('Gagal Menambahkan Jadwal Mata Kuliah');
        }
        // Close the modal
        $this->closeModal();
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
