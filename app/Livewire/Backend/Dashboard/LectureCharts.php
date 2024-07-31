<?php

namespace App\Livewire\Backend\Dashboard;

use App\Services\Attendance\AttendanceService;
use Carbon\Carbon;
use Livewire\Attributes\On;
use Livewire\Component;

class LectureCharts extends Component
{
    public $monthlyAttendances = [];
    public $filter = 'currentMonth';
    public $title = 'Grafik Absensi ';
    public $isAdmin = false;
    public $isDosen = false;
    public $isStudent = false;

    public function mount(AttendanceService $attendanceService)
    {
        $this->isAdmin = auth()->user()->role->name_alias == 'admin';
        $this->isDosen = auth()->user()->role->name_alias == 'dosen';
        $this->isStudent = auth()->user()->role->name_alias == 'mahasiswa';
        $year = now()->year;
        $month = now()->month;
        if ($this->isDosen) {
            $this->monthlyAttendances = $attendanceService->getMonthlyAttendance($year, $month, 'dosen', auth()->user()->id);
        } else if ($this->isAdmin) {
            $this->monthlyAttendances = $attendanceService->getMonthlyAttendance($year, $month, 'dosen');
        }
        $this->updateTitle();
    }

    public function updateChart(AttendanceService $attendanceService)
    {
        if ($this->isDosen) {
            $this->monthlyAttendances = $attendanceService->getFilteredAttendances($this->filter, 'dosen', auth()->user()->id);
        } else if ($this->isAdmin) {
            $this->monthlyAttendances = $attendanceService->getFilteredAttendances($this->filter, 'dosen');
        }
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
        Carbon::setLocale('id');
        $userLabel = $this->isAdmin || $this->isStudent ? 'Dosen' : auth()->user()->name;
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
        return view('livewire.backend.dashboard.lecture-charts');
    }
}
