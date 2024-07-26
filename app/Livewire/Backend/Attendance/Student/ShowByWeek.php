<?php

namespace App\Livewire\Backend\Attendance\Student;

use Carbon\Carbon;
use Livewire\Attributes\On;
use Livewire\Component;

class ShowByWeek extends Component
{
    public $startDate, $endDate;

    public function mount()
    {
        $this->startDate = Carbon::now()->startOfWeek(Carbon::MONDAY)->format('Y/m/d');
        $this->endDate = Carbon::now()->endOfWeek(Carbon::SUNDAY)->format('Y/m/d');
    }

    #[On('searchByWeek')]
    public function setDates($value)
    {
        $this->startDate = $value['startDate'];
        $this->endDate = $value['endDate'];
    }

    public function render()
    {
        return view('livewire.backend.attendance.student.show-by-week');
    }
}
