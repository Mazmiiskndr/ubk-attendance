<?php

namespace App\Livewire\Backend\Course;

use App\Services\Course\CourseService;
use Livewire\Component;

class StudentCourseScheduleDatatables extends Component
{
    public function render()
    {
        return view('livewire.backend.course.student-course-schedule-datatables');
    }

    public function getDataTable(CourseService $courseService)
    {
        return $courseService->getStudentCourseScheduleDatatables();
    }
}
