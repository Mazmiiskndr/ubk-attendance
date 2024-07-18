<?php

namespace App\Livewire\Backend\Course;

use App\Services\Course\CourseService;
use Livewire\Component;

class ScheduleDatatables extends Component
{
    public function render()
    {
        return view('livewire.backend.course.schedule-datatables');
    }

    public function getDataTable(CourseService $courseService)
    {
        return $courseService->getCourseSchedulesDatatables();
    }
}
