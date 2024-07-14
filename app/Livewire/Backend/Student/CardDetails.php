<?php

namespace App\Livewire\Backend\Student;

use Livewire\Component;

class CardDetails extends Component
{
    public $student;

    public function mount($student)
    {
        $this->student = $student;
    }

    public function render()
    {
        return view('livewire.backend.student.card-details');
    }
}
