<?php

namespace App\Livewire\Backend\Setting;

use App\Services\Setting\SettingService;
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
}
