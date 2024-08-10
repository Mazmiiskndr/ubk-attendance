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

    public $loadingMessage = "Loading...", $message = "Silahkan Daftarkan Finger Print Pada Perangkat!";

    public $polling = false;

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
    public function storeNewLecture(UserService $userService)
    {
        $user = $this->form->storeOrUpdate($userService);
        // Check if $user contains valid data or not.
        if ($user) {
            $state = $this->form->storeState($userService, $user);
            if ($state) {
                $this->dispatch('showLoading');
                // Polling untuk cek status sinkronisasi
                $this->dispatch('pollingStart');
                $this->polling = true;
            }
        } else {
            $this->dispatch('hideLoading');
            // Notify the frontend of failure
            $this->dispatchErrorEvent('Gagal Menambahkan Data Dosen');
        }
    }

    public function checkState(UserService $userService)
    {
        if (!$this->polling) {
            $this->dispatch('hideLoading'); // Hide loading when polling stops
            return;
        }
        // Cek status sinkronisasi
        $state = $userService->getStates();
        if ($state && $state->controller_notes) {
            $this->loadingMessage = $state->controller_notes;
            $this->dispatch('pollingStop');
            $this->polling = false;
            $this->dispatch('hideLoading');
            $this->dispatch('lectureCreated');
            return redirect()->route('backend.lecturers.index')->with('success', 'Data Dosen berhasil ditambahkan!');
        } else {
            $this->loadingMessage = "Melakukan Proses Pendaftaran";
        }
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
