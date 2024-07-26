<?php

namespace App\Livewire\Backend\Attendance\Student;

use Carbon\Carbon;
use Livewire\Attributes\On;
use Livewire\Component;

class ShowByMonth extends Component
{
    public $startDate, $endDate;

    public function mount()
    {
        $this->startDate = Carbon::now()->startOfMonth()->format('Y-m-d');
        $this->endDate = Carbon::now()->endOfMonth()->format('Y-m-d');
    }

    #[On('searchByMonth')]
    public function setDates($value)
    {
        $this->startDate = $value['startDate'];
        $this->endDate = $value['endDate'];
    }

    public function render()
    {
        return view('livewire.backend.attendance.student.show-by-month');
    }
}
