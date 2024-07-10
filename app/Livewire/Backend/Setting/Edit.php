<?php

namespace App\Livewire\Backend\Setting;

use App\Services\Setting\SettingService;
use App\Traits\{LivewireMessageEvents, CloseModalTrait};
use Livewire\Attributes\On;
use Livewire\Component;

class Edit extends Component
{
    use LivewireMessageEvents, CloseModalTrait;

    public $settingId, $checkInStart, $checkInEnd, $checkOutStart, $checkOutEnd, $holiday1, $holiday2, $time_zone, $ipAddress;

    public function render()
    {
        return view('livewire.backend.setting.edit');
    }

    #[On('deliverSettingToEditComponent')]
    public function receiveAndProcessSetting(SettingService $settingService, $settingId)
    {
        $setting = $settingService->getSettings();
        $this->settingId = $settingId;

        switch ($settingId) {
            case 1:
                $this->checkInStart = $setting->check_in_start;
                break;
            case 2:
                $this->checkInEnd = $setting->check_in_end;
                break;
            case 3:
                $this->checkOutStart = $setting->check_out_start;
                break;
            case 4:
                $this->checkOutEnd = $setting->check_out_end;
                break;
            case 5:
                $this->holiday1 = $setting->holiday_1;
                break;
            case 6:
                $this->holiday2 = $setting->holiday_2;
                break;
            case 7:
                $this->time_zone = $setting->time_zone;
                break;
            case 8:
                $this->ipAddress = $setting->ip_address;
                break;
            default:
                throw new \Exception("Invalid setting ID");
        }
        $this->dispatch('show-modal');
    }

    public function resetFields()
    {
        $this->checkInStart = null;
    }
}
