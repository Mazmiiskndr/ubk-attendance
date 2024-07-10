<?php

namespace App\Livewire\Backend\Setting;

use App\Services\Setting\SettingService;
use Livewire\Attributes\On;
use Livewire\Component;

class Datatables extends Component
{
    public function render()
    {
        return view('livewire.backend.setting.datatables');
    }

    public function getDataTable(SettingService $settingService)
    {
        return $settingService->getDatatables();
    }

    #[On('requestSettingById')]
    public function getSetting($settingId)
    {
        $this->dispatch('deliverSettingToEditComponent', $settingId);
    }

    /**
     * Refresh the DataTable when an  updated.
     */
    #[On('settingUpdated')]
    public function refreshDataTable()
    {
        $this->dispatch('refreshDatatable');
    }
}
