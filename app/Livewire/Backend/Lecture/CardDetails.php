<?php

namespace App\Livewire\Backend\Lecture;

use Livewire\Component;

class CardDetails extends Component
{
    public $lecture;

    public function mount($lecture)
    {
        $this->lecture = $lecture;
    }

    public function render()
    {
        return view('livewire.backend.lecture.card-details');
    }
}
