<?php

namespace App\Livewire\Backend\Setting;

use App\Livewire\Forms\Backend\Setting\CreateKelasForm;
use App\Services\Kelas\KelasService;
use App\Traits\{LivewireMessageEvents, CloseModalTrait};
use Livewire\Component;

class CreateKelas extends Component
{
    use LivewireMessageEvents, CloseModalTrait;

    /**
     * The CreateKelasForm instance associated with this object.
     * @var CreateKelasForm
     */
    public CreateKelasForm $form;
    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function render()
    {
        return view('livewire.backend.setting.create-kelas');
    }

    /**
     * Store a new kelas.
     * @param KelasService $kelasService
     * @return void
     */
    public function storeNewKelas(KelasService $kelasService)
    {
        $kelas = $this->form->storeOrUpdate($kelasService);
        // Check if $kelas contains valid data or not.
        if ($kelas) {
            // Let other components know that a kelas was created

            // Notify the frontend of success
            $this->dispatch('show-toast', ['type' => 'success', 'message' => 'Kelas berhasil ditambahkan!']);
            // Let other components know that a setting was updated
            $this->dispatch('kelasCreated', $kelas);
        } else {
            // Notify the frontend of failure
            $this->dispatchErrorEvent('Gagal Menambahkan Kelas');
        }
        // Close the modal
        $this->closeModal();
    }

    public function resetFields()
    {
        $this->form->name = '';
        $this->form->room = '';
    }
}
