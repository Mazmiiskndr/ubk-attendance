<?php

namespace App\Livewire\Backend\Attendance\Student;

use App\Services\Attendance\AttendanceService;
use App\Traits\{LivewireMessageEvents, CloseModalTrait};
use Livewire\Attributes\On;
use Livewire\Component;

class EditDate extends Component
{
    public $attendanceId;
    /**
     * This class uses the traits LivewireMessageEvents and CloseModalTrait.
     */
    use LivewireMessageEvents, CloseModalTrait;

    /**
     * The UpdateForm instance associated with this object.
     * @var UpdateCourseForm
     */
    // public UpdateCourseForm $form;

    public function render()
    {
        return view('livewire.backend.attendance.student.edit-date');
    }

    /**
     * The properties of a courses object.
     */
    #[On('deliverAttendanceToEditComponent')]
    public function receiveAndProcessCourse(AttendanceService $attendanceService, $attendanceId)
    {
        $this->attendanceId = base64_decode($attendanceId);
        if (!$this->attendanceId) {
            throw new \InvalidArgumentException("Invalid ID provided.");
        }

        // $course = $attendanceService->getCourseById($this->attendanceId);
        if ($course) {
            $this->form->setCourse($course);
        }
        $this->dispatch('show-modal');
    }
}
