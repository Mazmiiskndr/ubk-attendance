<?php

namespace App\Livewire\Backend\Dashboard;

use App\Services\Attendance\AttendanceService;
use App\Services\User\UserService;
use Livewire\Component;

class Cards extends Component
{
    public $totalStudents = 0, $totalLecturers = 0, $totalAttendancePerMonth = 0, $totalUsers = 0, $totalHadir = 0, $totalSakit = 0, $totalAlpa = 0;
    public function mount(UserService $userService, AttendanceService $attendanceService)
    {
        $startDate = now()->startOfMonth()->toDateString();
        $endDate = now()->endOfMonth()->toDateString();
        if (auth()->user()->role->name_alias == 'admin') {
            $this->totalStudents = $userService->countUsers('mahasiswa');
            $this->totalUsers = $userService->countUsers();
            $this->totalLecturers = $userService->countUsers('dosen');
            $this->totalAttendancePerMonth = $attendanceService->countAttendancesByDateRange($startDate, $endDate);
        } else if (auth()->user()->role->name_alias == 'mahasiswa') {
            $this->totalAttendancePerMonth = $attendanceService->countAttendancesByDateRange($startDate, $endDate, auth()->user()->id);
            $this->totalHadir = $attendanceService->countAttendancesByDateRange($startDate, $endDate, auth()->user()->id, "H");
            $this->totalSakit = $attendanceService->countAttendancesByDateRange($startDate, $endDate, auth()->user()->id, "S");
            $this->totalAlpa = $attendanceService->countAttendancesByDateRange($startDate, $endDate, auth()->user()->id, "A");
        } else {
            $this->totalAttendancePerMonth = $attendanceService->countAttendancesByDateRange($startDate, $endDate, auth()->user()->id);
            $this->totalStudents = $userService->countUsers('mahasiswa');
        }
    }

    public function render()
    {
        return view('livewire.backend.dashboard.cards');
    }

}
