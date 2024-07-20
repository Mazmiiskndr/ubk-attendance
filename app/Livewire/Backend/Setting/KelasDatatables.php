<?php

namespace App\Livewire\Backend\Setting;

use App\Services\Kelas\KelasService;
use Livewire\Attributes\On;
use Livewire\Component;

class KelasDatatables extends Component
{
    public function render()
    {
        return view('livewire.backend.setting.kelas-datatables');
    }

    public function getDataTable(KelasService $kelasService)
    {
        return $kelasService->getKelasDatatables();
    }

    #[On('requestKelasById')]
    public function getSchedule($kelasId)
    {
        $this->dispatch('deliverKelasToEditComponent', $kelasId);
    }

    #[On('confirmKelas')]
    public function deleteKelas(KelasService $kelasService, $kelasId)
    {
        try {
            $kelasService->deleteKelas(base64_decode($kelasId));

            $this->dispatch('show-toast', ['type' => 'success', 'message' => 'Kelas berhasil hapus!']);

            $this->refreshDataTable();
        } catch (\Throwable $th) {
            $this->dispatch('show-toast', ['type' => 'error', 'message' => 'Error : ' . $th->getMessage()]);
        }
    }

    #[On('deleteBatchKelas')]
    public function deleteBatchKelas(KelasService $kelasService, $kelasIds)
    {
        try {
            $kelasService->deleteKelas($kelasIds);

            $this->dispatch('show-toast', ['type' => 'success', 'message' => 'Kelas berhasil hapus!']);

            $this->refreshDataTable();
        } catch (\Throwable $th) {
            $this->dispatch('show-toast', ['type' => 'error', 'message' => 'Error : ' . $th->getMessage()]);
        }
    }

    /**
     * Refresh the DataTable when an  updated.
     */
    #[On(['kelasCreated', 'kelasUpdated'])]
    public function refreshDataTable()
    {
        $this->dispatch('refreshDatatable');
    }
}
