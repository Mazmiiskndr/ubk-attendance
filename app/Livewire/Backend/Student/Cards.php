<?php

namespace App\Livewire\Backend\Student;

use App\Services\User\UserService;
use Livewire\Component;

class Cards extends Component
{
    public $totalUsers = 0, $activeUsers = 0, $maleUsers = 0, $femaleUsers = 0;
    public function mount(UserService $userService)
    {
        $this->totalUsers = $userService->countUsers('mahasiswa');
        $this->activeUsers = $userService->countUsers('mahasiswa', 1);
        $this->maleUsers = $userService->countUsers('mahasiswa', null, 'Laki-laki');
        $this->femaleUsers = $userService->countUsers('mahasiswa', null, 'Perempuan');
    }
    public function render()
    {
        return view('livewire.backend.student.cards');
    }
}
