<?php

namespace App\Livewire\Backend\Dashboard;

use App\Services\Attendance\AttendanceService;
use Livewire\Attributes\On;
use Livewire\Component;

class LectureCharts extends Component
{
    public $monthlyAttendances = [];
    public $filter = 'currentMonth';

    public function mount(AttendanceService $attendanceService)
    {
        $year = now()->year;
        $month = now()->month;
        $this->monthlyAttendances = $attendanceService->getMonthlyAttendance($year, $month, 'mahasiswa');
    }

    public function updateChart(AttendanceService $attendanceService)
    {
        $this->monthlyAttendances = $attendanceService->getFilteredAttendances($this->filter, 'mahasiswa');
        $this->dispatch('chartUpdated', json_encode($this->monthlyAttendances));
    }

    #[On('refreshChart')]
    public function refreshChart($filter)
    {
        $this->filter = $filter;
        $this->updateChart(app(AttendanceService::class));
    }

    public function render()
    {
        return view('livewire.backend.dashboard.lecture-charts');
    }
}
