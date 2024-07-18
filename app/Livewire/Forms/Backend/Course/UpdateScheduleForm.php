<?php

namespace App\Livewire\Forms\Backend\Course;

use App\Services\Course\CourseService;
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
        $this->courseScheduleId = $courseSchedule->id;
    }

    /**
     * Get the validation rules for the model.
     * @return array
     */
    public function rules()
    {
        $courseService = app(CourseService::class);
        return $courseService->getValidationScheduleRules();
    }

    /**
     * Get the validation error messages from the schedule service.
     * @return array
     */
    public function messages()
    {
        $courseService = app(CourseService::class);
        return $courseService->getValidationScheduleErrorMessages();
    }

    /**
     * Store Or Update a new schedule.
     * @param CourseService $courseService Schedule service instance
     */
    public function storeOrUpdate(CourseService $courseService)
    {
        // Validate form fields
        $validated = $this->validate();
        $validated['courseId'] = $this->courseId;
        $validated['id'] = $this->courseScheduleId;
        // Attempt to create the new schedule
        $schedule = $courseService->storeOrUpdateSchedule($validated);
        // Reset the form for the next schedule
        $this->reset();
        return $schedule;
    }
}
