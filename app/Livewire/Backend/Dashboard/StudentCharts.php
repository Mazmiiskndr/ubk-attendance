<?php

namespace App\Livewire\Backend\Dashboard;

use App\Services\Attendance\AttendanceService;
use Livewire\Attributes\On;
use Livewire\Component;

class StudentCharts extends Component
{
    public $monthlyAttendances = [];
    public $filter = 'currentMonth';
    public $title = 'Grafik Absensi Mahasiswa Bulan ';

    public function mount(AttendanceService $attendanceService)
    {
        $year = now()->year;
        $month = now()->month;
        $this->monthlyAttendances = $attendanceService->getMonthlyAttendance($year, $month, 'mahasiswa');
        $this->updateTitle();
    }

    public function updateChart(AttendanceService $attendanceService)
    {
        $this->monthlyAttendances = $attendanceService->getFilteredAttendances($this->filter, 'mahasiswa');
        $this->updateTitle();
        $this->dispatch('studentChartUpdated', json_encode($this->monthlyAttendances));
    }

    #[On('refreshStudentChart')]
    public function refreshChart($filter)
    {
        $this->filter = $filter;
        $this->updateChart(app(AttendanceService::class));
    }

    public function updateTitle()
    {
        switch ($this->filter) {
            case 'today':
                $this->title = 'Grafik Absensi Mahasiswa Hari Ini';
                break;
            case 'yesterday':
                $this->title = 'Grafik Absensi Mahasiswa Kemarin';
                break;
            case 'last7Days':
                $this->title = 'Grafik Absensi Mahasiswa 7 Hari Terakhir';
                break;
            case 'last30Days':
                $this->title = 'Grafik Absensi Mahasiswa 30 Hari Terakhir';
                break;
            case 'currentMonth':
                $this->title = 'Grafik Absensi Mahasiswa Bulan ' . \Carbon\Carbon::now()->translatedFormat('F');
                break;
            case 'lastMonth':
                $this->title = 'Grafik Absensi Mahasiswa Bulan ' . \Carbon\Carbon::now()->subMonth()->translatedFormat('F');
                break;
            default:
                $this->title = 'Grafik Absensi Mahasiswa';
        }
    }

    public function render()
    {
        return view('livewire.backend.dashboard.student-charts');
    }
}
