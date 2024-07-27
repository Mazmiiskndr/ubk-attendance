<?php

namespace App\Livewire\Backend\Dashboard;

use App\Services\Attendance\AttendanceService;
use App\Services\User\UserService;
use Livewire\Component;

class Cards extends Component
{
    public $totalStudents = 0, $totalLecturers = 0, $totalAttendancePerMonth = 0, $totalUsers = 0;
    public function mount(UserService $userService, AttendanceService $attendanceService)
    {
        $startDate = now()->startOfMonth()->toDateString();
        $endDate = now()->endOfMonth()->toDateString();
        if (auth()->user()->role->name_alias == 'admin') {
            $this->totalStudents = $userService->countUsers('mahasiswa');
            $this->totalUsers = $userService->countUsers();
            $this->totalLecturers = $userService->countUsers('dosen');
            $this->totalAttendancePerMonth = $attendanceService->countAttendancesByDateRange($startDate, $endDate);
        } else {
            $this->totalAttendancePerMonth = $attendanceService->countAttendancesByDateRange($startDate, $endDate, auth()->user()->id);
        }
    }

    public function render()
    {
        return view('livewire.backend.dashboard.cards');
    }

}
