<?php

namespace App\Livewire\Backend\Attendance\Student;

use Livewire\Component;

class SearchByMonth extends Component
{
    public $searchByMonth;
    public $startDate;
    public $endDate;

    public function mount()
    {
        $this->searchByMonth = null;
        $this->startDate = null;
        $this->endDate = null;
    }

    public function updatingSearchByMonth($value)
    {
        $dates = explode(" to ", $value);
        $this->startDate = $dates[0] ?? null;
        $this->endDate = $dates[1] ?? null;

        if ($this->startDate && $this->endDate) {
            $this->dispatch('searchByMonth', ['startDate' => $this->startDate, 'endDate' => $this->endDate]);
        }
    }

    public function render()
    {
        return view('livewire.backend.attendance.student.search-by-month');
    }
}
