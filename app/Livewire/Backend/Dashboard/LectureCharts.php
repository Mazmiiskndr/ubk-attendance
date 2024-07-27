<?php

namespace App\Livewire\Backend\Dashboard;

use App\Services\Attendance\AttendanceService;
use Livewire\Attributes\On;
use Livewire\Component;

class LectureCharts extends Component
{
    public $monthlyAttendances = [];
    public $filter = 'currentMonth';
    public $title = 'Grafik Absensi Dosen Bulan ';

    public function mount(AttendanceService $attendanceService)
    {
        $year = now()->year;
        $month = now()->month;
        $this->monthlyAttendances = $attendanceService->getMonthlyAttendance($year, $month, 'dosen');
        $this->updateTitle();
    }

    public function updateChart(AttendanceService $attendanceService)
    {
        $this->monthlyAttendances = $attendanceService->getFilteredAttendances($this->filter, 'dosen');
        $this->updateTitle();
        $this->dispatch('chartUpdated', json_encode($this->monthlyAttendances));
    }

    #[On('refreshChart')]
    public function refreshChart($filter)
    {
        $this->filter = $filter;
        $this->updateChart(app(AttendanceService::class));
    }

    public function updateTitle()
    {
        switch ($this->filter) {
            case 'today':
                $this->title = 'Grafik Absensi Dosen Hari Ini';
                break;
            case 'yesterday':
                $this->title = 'Grafik Absensi Dosen Kemarin';
                break;
            case 'last7Days':
                $this->title = 'Grafik Absensi Dosen 7 Hari Terakhir';
                break;
            case 'last30Days':
                $this->title = 'Grafik Absensi Dosen 30 Hari Terakhir';
                break;
            case 'currentMonth':
                $this->title = 'Grafik Absensi Dosen Bulan ' . \Carbon\Carbon::now()->translatedFormat('F');
                break;
            case 'lastMonth':
                $this->title = 'Grafik Absensi Dosen Bulan ' . \Carbon\Carbon::now()->subMonth()->translatedFormat('F');
                break;
            default:
                $this->title = 'Grafik Absensi Dosen';
        }
    }

    public function render()
    {
        return view('livewire.backend.dashboard.lecture-charts');
    }
}
