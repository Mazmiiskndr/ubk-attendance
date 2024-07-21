<?php

namespace App\Livewire\Backend\Lecture;

use App\Livewire\Forms\Backend\Lecture\UpdateForm;
use App\Services\User\UserService;
use App\Traits\{LivewireMessageEvents, CloseModalTrait};
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

    public $lecture;

    public function mount($lecture)
    {
        $this->form->setLecture($lecture);
        $this->lecture = $lecture;
    }

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function render()
    {
        return view('livewire.backend.lecture.edit');
    }

    /**
     * Update a user.
     * @param UserService $userService
     * @return void
     */
    public function updateLecture(UserService $userService)
    {
        $user = $this->form->storeOrUpdate($userService);
        // Check if $user contains valid data or not.
        if ($user) {
            // Let other components know that a user was created
            $this->dispatch('lectureUpdated', $user);

            // Notify the frontend of success
            return redirect()->route('backend.lecturers.index')->with('success', 'Data Dosen berhasil di perbaharui!');
        } else {
            // Notify the frontend of failure
            $this->dispatchErrorEvent('Gagal Mengubah Data Dosen');
        }
        // Close the modal
        $this->closeModal();
    }

    /**
     * Reset form fields to their default state.
     */
    public function resetFields()
    {
        $this->form->idLecture = '';
        $this->form->name = '';
        $this->form->identNumber = '';
        $this->form->email = '';
        $this->form->phoneNumber = '';
        $this->form->gender = '';
        $this->form->images = '';
        $this->form->address = '';
    }
}
