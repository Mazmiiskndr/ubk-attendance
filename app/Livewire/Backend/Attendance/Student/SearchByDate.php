<?php

namespace App\Livewire\Backend\Attendance\Student;

use Livewire\Component;

class SearchByDate extends Component
{
    public $searchByDate;
    public function mount()
    {
        $this->searchByDate = null;
    }

    public function updatingSearchByDate($value)
    {
        $this->dispatch('searchByDate', ['searchByDate' => $value]);
    }
    public function render()
    {
        return view('livewire.backend.attendance.student.search-by-date');
    }
}
