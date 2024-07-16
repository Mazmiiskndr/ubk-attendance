<?php

namespace App\Livewire\Backend\Student;

use Livewire\Component;

class Edit extends Component
{
    public $student;

    public function mount($student)
    {
        $this->student = $student;
    }

    public function render()
    {
        return view('livewire.backend.student.edit');
    }
}
