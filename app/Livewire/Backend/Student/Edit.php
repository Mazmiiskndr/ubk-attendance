<?php

namespace App\Livewire\Backend\Student;

use App\Livewire\Forms\Backend\Student\UpdateForm;
use App\Traits\{CloseModalTrait, LivewireMessageEvents};
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;
    /**
     * This class uses the traits LivewireMessageEvents and CloseModalTrait.
     */
    use LivewireMessageEvents, CloseModalTrait;

    /**
     * The UpdateForm instance associated with this object.
     * @var UpdateForm
     */
    public UpdateForm $form;

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
