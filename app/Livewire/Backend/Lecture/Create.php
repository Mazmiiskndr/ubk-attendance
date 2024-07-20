<?php

namespace App\Livewire\Backend\Lecture;

use App\Livewire\Forms\Backend\Lecture\CreateForm;
use App\Services\User\UserService;
use App\Traits\{LivewireMessageEvents, CloseModalTrait};
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;
    /**
     * This class uses the traits LivewireMessageEvents and CloseModalTrait.
     */
    use LivewireMessageEvents, CloseModalTrait;

    /**
     * The CreateForm instance associated with this object.
     * @var CreateForm
     */
    public CreateForm $form;

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function render()
    {
        return view('livewire.backend.lecture.create');
    }

    /**
     * Store a new user.
     * @param UserService $userService
     * @return void
     */
    public function storeNewStudent(UserService $userService)
    {
        $user = $this->form->storeOrUpdate($userService);
        // Check if $user contains valid data or not.
        if ($user) {
            // Let other components know that a user was created
            $this->dispatch('lectureCreated', $user);

            // Notify the frontend of success
            return redirect()->route('backend.students.index')->with('success', 'Data Dosen berhasil ditambahkan!');
        } else {
            // Notify the frontend of failure
            $this->dispatchErrorEvent('Gagal Menambahkan Data Dosen');
        }
        // Close the modal
        $this->closeModal();
    }

    /**
     * Reset form fields to their default state.
     */
    public function resetFields()
    {
        $this->form->name = '';
        $this->form->identNumber = '';
        $this->form->email = '';
        $this->form->phoneNumber = '';
        $this->form->gender = '';
        $this->form->images = '';
        $this->form->address = '';
    }

}