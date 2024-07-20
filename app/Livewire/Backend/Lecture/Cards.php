<?php

namespace App\Livewire\Backend\Lecture;

use App\Services\User\UserService;
use Livewire\Component;

class Cards extends Component
{
    public $totalUsers = 0, $activeUsers = 0, $maleUsers = 0, $femaleUsers = 0;
    public function mount(UserService $userService)
    {
        $this->totalUsers = $userService->countUsers('dosen');
        $this->activeUsers = $userService->countUsers('dosen', 1);
        $this->maleUsers = $userService->countUsers('dosen', null, 'Laki-laki');
        $this->femaleUsers = $userService->countUsers('dosen', null, 'Perempuan');
    }

    public function render()
    {
        return view('livewire.backend.lecture.cards');
    }
}
