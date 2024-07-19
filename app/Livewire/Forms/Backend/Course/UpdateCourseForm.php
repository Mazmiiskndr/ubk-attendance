<?php

namespace App\Livewire\Forms\Backend\Course;

use App\Services\Course\CourseService;
use Livewire\Attributes\Validate;
use Livewire\Form;

class UpdateCourseForm extends Form
{
    /**
     * The properties of a courses object.
     */
    public $name, $lecturerId, $courseId;

    public function setCourse($course)
    {
        $this->name = $course->name;
        $this->courseId = $course->id;
        $this->lecturerId = $course->lecturer_id;
    }

    /**
     * Get the validation rules for the model.
     * @return array
     */
    public function rules()
    {
        $courseService = app(CourseService::class);
        return $courseService->getValidationCourseRules();
    }

    /**
     * Get the validation error messages from the course service.
     * @return array
     */
    public function messages()
    {
        $courseService = app(CourseService::class);
        return $courseService->getValidationCourseErrorMessages();
    }

    /**
     * Store Or Update a new course.
     * @param CourseService $courseService Course service instance
     */
    public function storeOrUpdate(CourseService $courseService)
    {
        // Validate form fields
        $validated = $this->validate();
        $validated['id'] = $this->courseId;
        // Attempt to create the new course
        $course = $courseService->storeOrUpdateCourse($validated);
        // Reset the form for the next course
        $this->reset();
        return $course;
    }

}
