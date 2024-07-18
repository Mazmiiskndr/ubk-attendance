<?php

namespace App\Livewire\Forms\Backend\Course;

use App\Services\Course\CourseService;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CreateScheduleForm extends Form
{
    /**
     * The properties of a schedules object.
     */
    public $checkInStart, $checkInEnd, $day, $checkOutStart, $checkOutEnd, $courseId;

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
        // Attempt to create the new schedule
        $schedule = $courseService->storeOrUpdateSchedule($validated);
        // Reset the form for the next schedule
        $this->reset();
        return $schedule;
    }
}
