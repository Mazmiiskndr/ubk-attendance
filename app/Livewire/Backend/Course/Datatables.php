<?php

namespace App\Livewire\Backend\Course;

use App\Services\Course\CourseService;
use Livewire\Component;

class Datatables extends Component
{
    public function render()
    {
        return view('livewire.backend.course.datatables');
    }

    public function getDataTable(CourseService $courseService)
    {
        return $courseService->getCourseDatatables();
    }
}
