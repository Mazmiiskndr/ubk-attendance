<?php

namespace App\Livewire\Backend\Attendance\Student;

use App\Livewire\Forms\Backend\Atttendance\Student\UpdateDateForm;
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
     * @var UpdateDateForm
     */
    public UpdateDateForm $form;

    public function render()
    {
        return view('livewire.backend.attendance.student.edit-date');
    }

    /**
     * The properties of a attendances object.
     */
    #[On('deliverAttendanceToEditComponent')]
    public function receiveAndProcessAttendance(AttendanceService $attendanceService, $attendanceId)
    {
        $this->attendanceId = base64_decode($attendanceId);
        if (!$this->attendanceId) {
            throw new \InvalidArgumentException("Invalid ID provided.");
        }

        $attendance = $attendanceService->getAttendanceById($this->attendanceId);
        if ($attendance) {
            $this->form->setAttendance($attendance);
        }
        $this->dispatch('show-modal');
    }

    public function resetFields()
    {
        $this->form->attendanceId = '';
        $this->form->userId = '';
        $this->form->checkIn = '';
        $this->form->checkOut = '';
        $this->form->attendanceDate = '';
        $this->form->remarks = '';
        $this->form->name = '';
        $this->form->courseName = '';
    }
}
