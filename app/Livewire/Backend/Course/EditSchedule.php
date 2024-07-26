<?php

namespace App\Livewire\Backend\Course;

use App\Livewire\Forms\Backend\Course\UpdateScheduleForm;
use App\Services\Course\CourseService;
use App\Traits\{LivewireMessageEvents, CloseModalTrait};
use Livewire\Attributes\On;
use Livewire\Component;

class EditSchedule extends Component
{
    /**
     * This class uses the traits LivewireMessageEvents and CloseModalTrait.
     */
    use LivewireMessageEvents, CloseModalTrait;

    /**
     * The UpdateForm instance associated with this object.
     * @var UpdateScheduleForm
     */
    public UpdateScheduleForm $form;

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    /**
     * The properties of a schedules object.
     */
    public $checkInStart, $checkInEnd, $day, $checkOutStart, $checkOutEnd, $courseId, $courseScheduleId;

    #[On('deliverScheduleToEditComponent')]
    public function receiveAndProcessSchedule(CourseService $courseService, $courseScheduleId)
    {
        $this->courseScheduleId = base64_decode($courseScheduleId);
        if (!$this->courseScheduleId) {
            throw new \InvalidArgumentException("Invalid ID provided.");
        }

        $courseSchedule = $courseService->getCourseScheduleById($this->courseScheduleId);
        if ($courseSchedule) {
            $this->form->setSchedule($courseSchedule);
        }
        $this->dispatch('show-modal');
    }

    public function render()
    {
        return view('livewire.backend.course.edit-schedule');
    }

    /**
     * Update a course schedule.
     * @param CourseService $courseService
     * @return void
     */
    public function updateSchedule(CourseService $courseService)
    {
        $schedule = $this->form->storeOrUpdate($courseService);
        // Check if $schedule contains valid data or not.
        if ($schedule) {
            // Notify the frontend of success
            $this->dispatch('show-toast', ['type' => 'success', 'message' => 'Jadwal Mata Kuliah berhasil di perbaharui!']);
            // Let other components know that a setting was updated
            $this->dispatch('scheduleUpdated', $schedule);
        } else {
            // Notify the frontend of failure
            $this->dispatchErrorEvent('Gagal Mengubah Jadwal Mata Kuliah');
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
        $this->form->courseScheduleId = '';
        $this->form->courseId = '';
    }
}
