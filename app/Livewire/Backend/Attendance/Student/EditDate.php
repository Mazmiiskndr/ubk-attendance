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

    public function updated($property)
    {
        $this->validateOnly($property);
    }

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

    /**
     * Update a attendance.
     * @param AttendanceService $attendanceService
     * @return void
     */
    public function updateAttendanceDate(AttendanceService $attendanceService)
    {
        $attendance = $this->form->storeOrUpdate($attendanceService);
        // Check if $attendance contains valid data or not.
        if ($attendance) {
            // Notify the frontend of success
            $this->dispatch('show-toast', ['type' => 'success', 'message' => 'Presensi Mahasiswa Pertanggal berhasil di perbaharui!']);
            // Let other components know that a setting was updated
            $this->dispatch('attendanceUpdated', $attendance);
        } else {
            // Notify the frontend of failure
            $this->dispatchErrorEvent('Gagal Mengubah Presensi Mahasiswa Pertanggal');
        }
        // Close the modal
        $this->closeModal();
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
