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

    /**
     * Refresh the DataTable when an  updated.
     */
    // #[On('settingUpdated')]
    public function refreshDataTable()
    {
        $this->dispatch('refreshDatatable');
    }
}
