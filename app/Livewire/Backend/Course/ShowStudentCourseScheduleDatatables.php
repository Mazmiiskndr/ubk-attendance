<?php

namespace App\Livewire\Backend\Course;

use App\Services\Course\CourseService;
use Livewire\Component;

class ShowStudentCourseScheduleDatatables extends Component
{
    public $courseId;

    public function mount($courseId)
    {
        $this->courseId = $courseId;
    }

    public function render()
    {
        return view('livewire.backend.course.show-student-course-schedule-datatables');
    }

    public function getDataTable(CourseService $courseService, $courseId = null)
    {
        return $courseService->getShowStudentCourseScheduleDatatables($courseId);
    }
}
