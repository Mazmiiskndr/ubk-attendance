<?php

namespace App\Livewire\Backend\Setting;

use App\Livewire\Forms\Backend\Setting\UpdateKelasForm;
use App\Services\Kelas\KelasService;
use App\Traits\{LivewireMessageEvents, CloseModalTrait};
use Livewire\Attributes\On;
use Livewire\Component;

class EditKelas extends Component
{

    /**
     * This class uses the traits LivewireMessageEvents and CloseModalTrait.
     */
    use LivewireMessageEvents, CloseModalTrait;

    /**
     * The UpdateForm instance associated with this object.
     * @var UpdateKelasForm
     */
    public UpdateKelasForm $form;

    /**
     * The properties of a kelas object.
     */
    // public $checkInStart, $checkInEnd, $day, $checkOutStart, $checkOutEnd, $kelasId, $kelasId;

    #[On('deliverKelasToEditComponent')]
    public function receiveAndProcessKelas(KelasService $kelasService, $kelasId)
    {
        $this->kelasId = base64_decode($kelasId);
        if (!$this->kelasId) {
            throw new \InvalidArgumentException("Invalid ID provided.");
        }

        $kelas = $kelasService->getKelasById($this->kelasId);
        if ($kelas) {
            $this->form->setKelas($kelas);
        }
        $this->dispatch('show-modal');
    }
    public function render()
    {
        return view('livewire.backend.setting.edit-kelas');
    }

    /**
     * Update a kelas.
     * @param KelasService $kelasService
     * @return void
     */
    public function updateKelas(KelasService $kelasService)
    {
        $kelas = $this->form->storeOrUpdate($kelasService);
        // Check if $kelas contains valid data or not.
        if ($kelas) {
            // Let other components know that a kelas was updated
            $this->dispatch('kelasUpdated', $kelas);

            // Notify the frontend of success
            $this->dispatch('show-toast', ['type' => 'success', 'message' => 'Kelas berhasil di perbaharui!']);
            // Let other components know that a setting was updated
            $this->dispatch('kelasUpdated', $kelas);
        } else {
            // Notify the frontend of failure
            $this->dispatchErrorEvent('Gagal Mengubah Kelas');
        }
        // Close the modal
        $this->closeModal();
    }

    public function resetFields()
    {
        $this->form->name = '';
        $this->form->kelasId = '';
    }
}
