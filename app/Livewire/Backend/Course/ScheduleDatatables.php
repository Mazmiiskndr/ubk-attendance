<?php

namespace App\Livewire\Backend\Course;

use App\Services\Course\CourseService;
use Livewire\Attributes\On;
use Livewire\Component;

class ScheduleDatatables extends Component
{
    public $courseId;

    public function mount($courseId)
    {
        $this->courseId = $courseId;
    }

    public function render()
    {
        return view('livewire.backend.course.schedule-datatables');
    }

    #[On('requestCourseScheduleById')]
    public function getSchedule($courseScheduleId)
    {
        $this->dispatch('deliverScheduleToEditComponent', $courseScheduleId);
    }

    public function getDataTable(CourseService $courseService, $courseId = null)
    {
        return $courseService->getCourseSchedulesDatatables($courseId);
    }

    #[On('confirmCourseSchedule')]
    public function deleteCourseSchedule(CourseService $courseService, $courseScheduleId)
    {
        try {
            $courseService->deleteCourseSchedules(base64_decode($courseScheduleId));

            $this->dispatch('show-toast', ['type' => 'success', 'message' => 'Jadwal Mata Kuliah berhasil hapus!']);

            $this->refreshDataTable();
        } catch (\Throwable $th) {
            $this->dispatch('show-toast', ['type' => 'error', 'message' => 'Error : ' . $th->getMessage()]);
        }
    }

    #[On('deleteBatchCourseSchedules')]
    public function deleteBatchCourses(CourseService $courseService, $courseScheduleIds)
    {
        try {
            $courseService->deleteCourseSchedules($courseScheduleIds);

            $this->dispatch('show-toast', ['type' => 'success', 'message' => 'Jadwal Mata Kuliah berhasil hapus!']);

            $this->refreshDataTable();
        } catch (\Throwable $th) {
            $this->dispatch('show-toast', ['type' => 'error', 'message' => 'Error : ' . $th->getMessage()]);
        }
    }

    #[On(['scheduleCreated', 'scheduleUpdated'])]
    public function refreshDataTable()
    {
        $this->dispatch('refreshDatatable');
    }
}
