<?php

namespace App\Livewire\Backend\Attendance\Student;

use Livewire\Attributes\On;
use Livewire\Component;

class ShowByDate extends Component
{
    public $date;


    public function mount()
    {
        $this->date = date("Y/m/d");
    }

    #[On('searchByDate')]
    public function setDate($value)
    {
        $this->date = $value['searchByDate'];
    }
    public function render()
    {
        return view('livewire.backend.attendance.student.show-by-date');
    }
}
