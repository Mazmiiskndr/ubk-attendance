<?php

namespace App\Livewire\Backend\Dashboard;

use App\Services\Attendance\AttendanceService;
use Carbon\Carbon;
use Livewire\Attributes\On;
use Livewire\Component;

class StudentCharts extends Component
{
    public $monthlyAttendances = [];
    public $filter = 'currentMonth';
    public $title = 'Grafik Absensi ';
    public $isAdmin = false;
    public $isDosen = false;

    public function mount(AttendanceService $attendanceService)
    {
        $this->isAdmin = auth()->user()->role->name_alias == 'admin';
        $this->isDosen = auth()->user()->role->name_alias == 'dosen';

        $year = now()->year;
        $month = now()->month;
        if ($this->isAdmin || $this->isDosen) {
            $this->monthlyAttendances = $attendanceService->getMonthlyAttendance($year, $month, 'mahasiswa');
        } else if (auth()->user()->role->name_alias == 'mahasiswa') {
            $this->monthlyAttendances = $attendanceService->getMonthlyAttendance($year, $month, 'mahasiswa', auth()->user()->id);
        }
        $this->updateTitle();
    }

    public function updateChart(AttendanceService $attendanceService)
    {
        if ($this->isAdmin || $this->isDosen) {
            $this->monthlyAttendances = $attendanceService->getFilteredAttendances($this->filter, 'mahasiswa');
        } else if (auth()->user()->role->name_alias == 'mahasiswa') {
            $this->monthlyAttendances = $attendanceService->getFilteredAttendances($this->filter, 'mahasiswa', auth()->user()->id);
        }
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
        Carbon::setLocale('id');
        $userLabel = $this->isAdmin || $this->isDosen ? 'Mahasiswa' : auth()->user()->name;
        $baseTitle = 'Grafik Absensi ' . $userLabel;

        switch ($this->filter) {
            case 'today':
                $this->title = $baseTitle . ' Hari Ini';
                break;
            case 'yesterday':
                $this->title = $baseTitle . ' Kemarin';
                break;
            case 'last7Days':
                $this->title = $baseTitle . ' 7 Hari Terakhir';
                break;
            case 'last30Days':
                $this->title = $baseTitle . ' 30 Hari Terakhir';
                break;
            case 'currentMonth':
                $this->title = $baseTitle . ' Bulan ' . Carbon::now()->translatedFormat('F');
                break;
            case 'lastMonth':
                $lastMonth = Carbon::now()->subMonthNoOverflow()->startOfMonth();
                $this->title = $baseTitle . ' Bulan ' . $lastMonth->translatedFormat('F');
                break;
            default:
                $this->title = $baseTitle;
        }
    }

    public function render()
    {
        return view('livewire.backend.dashboard.student-charts');
    }
}
