<?php

namespace App\Livewire\Backend\Student;

use App\Livewire\Forms\Backend\Student\CreateForm;
use App\Services\Kelas\KelasService;
use App\Services\User\UserService;
use App\Traits\{CloseModalTrait, LivewireMessageEvents};
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

    public $kelas, $loadingMessage = "Loading...", $message = "Silahkan Daftarkan Finger Print Pada Perangkat!";

    public $polling = false;

    public function mount(KelasService $kelasService)
    {
        $this->kelas = $kelasService->getKelas();
    }

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function render()
    {
        return view('livewire.backend.student.create');
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
            $this->dispatchErrorEvent('Gagal Menambahkan Data Mahasiswa');
        }
        // Close the modal
        $this->closeModal();
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
            $this->dispatch('userCreated');
            return redirect()->route('backend.students.index')->with('success', 'Data Mahasiswa berhasil ditambahkan!');
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
        $this->form->semester = '';
        $this->form->classId = '';
        $this->form->images = '';
        $this->form->address = '';
    }

}
