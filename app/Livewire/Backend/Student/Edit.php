<?php

namespace App\Livewire\Backend\Student;

use App\Livewire\Forms\Backend\Student\UpdateForm;
use App\Services\User\UserService;
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
        $this->form->setStudent($student);
        $this->student = $student;
    }

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function render()
    {
        return view('livewire.backend.student.edit');
    }

    /**
     * Update a user.
     * @param UserService $userService
     * @return void
     */
    public function updateStudent(UserService $userService)
    {
        $user = $this->form->storeOrUpdate($userService);
        // Check if $user contains valid data or not.
        if ($user) {
            // Let other components know that a user was created
            $this->dispatch('userUpdated', $user);

            // Notify the frontend of success
            return redirect()->route('backend.students.index')->with('success', 'Data Mahasiswa berhasil di perbaharui!');
        } else {
            // Notify the frontend of failure
            $this->dispatchErrorEvent('Gagal Mengubah Data Mahsiswa');
        }
        // Close the modal
        $this->closeModal();
    }

    /**
     * Reset form fields to their default state.
     */
    public function resetFields()
    {
        $this->form->idStudent = '';
        $this->form->name = '';
        $this->form->identNumber = '';
        $this->form->email = '';
        $this->form->phoneNumber = '';
        $this->form->gender = '';
        $this->form->semester = '';
        $this->form->class = '';
        $this->form->images = '';
        $this->form->address = '';
    }
}
