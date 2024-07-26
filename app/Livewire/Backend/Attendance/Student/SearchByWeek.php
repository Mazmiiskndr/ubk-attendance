<?php

namespace App\Livewire\Backend\Attendance\Student;

use Livewire\Component;

class SearchByWeek extends Component
{
    public $searchByWeek;
    public $startDate;
    public $endDate;

    public function mount()
    {
        $this->searchByWeek = null;
        $this->startDate = null;
        $this->endDate = null;
    }

    public function updatingSearchByWeek($value)
    {
        $dates = explode(" to ", $value);
        $this->startDate = $dates[0] ?? null;
        $this->endDate = $dates[1] ?? null;

        if ($this->startDate && $this->endDate) {
            $this->dispatch('searchByWeek', ['startDate' => $this->startDate, 'endDate' => $this->endDate]);
        }
    }

    public function render()
    {
        return view('livewire.backend.attendance.student.search-by-week');
    }
}
