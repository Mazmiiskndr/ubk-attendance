<?php

namespace App\Livewire\Forms\Backend\Attendance\Student;

use App\Services\Attendance\AttendanceService;
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

    /**
     * Get the validation rules for the model.
     * @return array
     */
    public function rules()
    {
        $attendanceService = app(AttendanceService::class);
        return $attendanceService->getValidationRules();
    }

    /**
     * Get the validation error messages from the attendance service.
     * @return array
     */
    public function messages()
    {
        $attendanceService = app(AttendanceService::class);
        return $attendanceService->getValidationErrorMessages();
    }

    /**
     * Store Or Update a new attendance.
     * @param AttendanceService $attendanceService Attendance service instance
     */
    public function storeOrUpdate(AttendanceService $attendanceService)
    {
        // Validate form fields
        $validated = $this->validate();
        $validated['id'] = $this->attendanceId;
        // Attempt to create the new attendance
        $attendance = $attendanceService->storeOrUpdate($validated);
        // Reset the form for the next attendance
        $this->reset();
        return $attendance;
    }
}
