<?php

namespace App\Livewire\Backend\Course;

use App\Services\Course\CourseService;
use Livewire\Attributes\On;
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

    #[On('confirmCourse')]
    public function deleteCourse(CourseService $courseService, $courseId)
    {
        try {
            $courseService->deleteCourses(base64_decode($courseId));

            $this->dispatch('show-toast', ['type' => 'success', 'message' => 'Mata Kuliah berhasil hapus!']);

            $this->refreshDataTable();
        } catch (\Throwable $th) {
            $this->dispatch('show-toast', ['type' => 'error', 'message' => 'Error : ' . $th->getMessage()]);
        }
    }

    #[On('deleteBatchCourses')]
    public function deleteBatchCourses(CourseService $courseService, $courseIds)
    {
        try {
            $courseService->deleteCourses($courseIds);

            $this->dispatch('show-toast', ['type' => 'success', 'message' => 'Mata Kuliah berhasil hapus!']);

            $this->refreshDataTable();
        } catch (\Throwable $th) {
            $this->dispatch('show-toast', ['type' => 'error', 'message' => 'Error : ' . $th->getMessage()]);
        }
    }

    public function refreshDataTable()
    {
        $this->dispatch('refreshDatatable');
    }
}
