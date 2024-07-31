<?php

namespace App\Livewire\Backend\Dashboard;

use App\Services\Attendance\AttendanceService;
use App\Services\User\UserService;
use Livewire\Component;

class Cards extends Component
{
    public $totalStudents = 0, $totalLecturers = 0, $totalAttendancePerMonth = 0, $totalUsers = 0, $totalHadir = 0, $totalSakit = 0, $totalAlpa = 0, $totalAttendanceStudent = 0;
    public $isAdmin = false, $isDosen = false, $isStudent = false;

    public function mount(UserService $userService, AttendanceService $attendanceService)
    {
        $this->isAdmin = auth()->user()->role->name_alias == 'admin';
        $this->isDosen = auth()->user()->role->name_alias == 'dosen';
        $this->isStudent = auth()->user()->role->name_alias == 'mahasiswa';

        $this->loadData($userService, $attendanceService);
    }

    protected function loadData(UserService $userService, AttendanceService $attendanceService)
    {
        $startDate = now()->startOfMonth()->toDateString();
        $endDate = now()->endOfMonth()->toDateString();

        if ($this->isAdmin) {
            $this->loadAdminData($userService, $attendanceService, $startDate, $endDate);
        } elseif ($this->isStudent) {
            $this->loadStudentData($attendanceService, $startDate, $endDate);
        } else {
            $this->loadDosenData($userService, $attendanceService, $startDate, $endDate);
        }
    }

    protected function loadAdminData(UserService $userService, AttendanceService $attendanceService, $startDate, $endDate)
    {
        $this->totalStudents = $userService->countUsers('mahasiswa');
        $this->totalUsers = $userService->countUsers();
        $this->totalLecturers = $userService->countUsers('dosen');
        $this->totalAttendancePerMonth = $attendanceService->countAttendancesByDateRange($startDate, $endDate);
    }

    protected function loadStudentData(AttendanceService $attendanceService, $startDate, $endDate)
    {
        $userId = auth()->user()->id;
        $this->totalAttendancePerMonth = $attendanceService->countAttendancesByDateRange($startDate, $endDate, $userId);
        $this->totalHadir = $attendanceService->countAttendancesByDateRange($startDate, $endDate, $userId, "H");
        $this->totalSakit = $attendanceService->countAttendancesByDateRange($startDate, $endDate, $userId, "S");
        $this->totalAlpa = $attendanceService->countAttendancesByDateRange($startDate, $endDate, $userId, "A");
    }

    protected function loadDosenData(UserService $userService, AttendanceService $attendanceService, $startDate, $endDate)
    {
        $userId = auth()->user()->id;
        $this->totalAttendancePerMonth = $attendanceService->countAttendancesByDateRange($startDate, $endDate, $userId);
        $this->totalAttendanceStudent = $attendanceService->countAttendancesByDateRange($startDate, $endDate, null, null, 'mahasiswa');
        $this->totalStudents = $userService->countUsers('mahasiswa');
    }

    public function render()
    {
        return view('livewire.backend.dashboard.cards');
    }
}
