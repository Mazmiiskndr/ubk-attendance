<?php

namespace App\Livewire\Backend\Setting;

use App\Services\Setting\SettingService;
use App\Traits\{LivewireMessageEvents, CloseModalTrait};
use Livewire\Attributes\On;
use Livewire\Component;

class Edit extends Component
{
    use LivewireMessageEvents, CloseModalTrait;

    public $settingId, $checkInStart, $checkInEnd, $checkOutStart, $checkOutEnd, $holiday1, $holiday2, $timeZone, $ipAddress;

    public function updated($property)
    {
        $settingService = app(SettingService::class);
        $this->validateOnly($property, $settingService->getValidationRules($this->settingId), $settingService->getValidationErrorMessages());
    }

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
                $this->timeZone = $setting->time_zone;
                break;
            case 8:
                $this->ipAddress = $setting->ip_address;
                break;
            default:
                throw new \Exception("Invalid setting ID");
        }
        $this->dispatch('show-modal');
    }

    public function updateSetting(SettingService $settingService)
    {
        $this->validate($settingService->getValidationRules($this->settingId), $settingService->getValidationErrorMessages());
        $properties = $this->prepareSettingData();
        try {
            // Attempt to update the settings
            $isUpdated = $settingService->updateSetting($properties);

            // Check if the settings were updated successfully
            if ($isUpdated === false) {
                throw new \InvalidArgumentException('Gagal memperbarui pengaturan!');
            } elseif ($isUpdated === 0) {
                throw new \InvalidArgumentException('Tidak ada perubahan terdeteksi. Silakan ubah pengaturan sebelum menyimpan.');
            }
            // Notify the frontend of success
            // Notify the frontend of success
            $this->dispatch('show-toast', ['type' => 'success', 'message' => 'Pengaturan berhasil diperbarui!']);
            // Let other components know that a setting was updated
            $this->dispatch('settingUpdated', true);
        } catch (\Throwable $th) {
            // Notify the frontend of the error
            $this->dispatch('show-toast', ['type' => 'error', 'message' => 'Error : ' . $th->getMessage()]);
        } finally {
            // Ensure the modal is closed
            $this->closeModal();
        }
    }

    protected function prepareSettingData(): array
    {
        // Map properties to the database columns
        $properties = [
            'setting_id' => $this->settingId,
            'check_in_start' => $this->checkInStart,
            'check_in_end' => $this->checkInEnd,
            'check_out_start' => $this->checkOutStart,
            'check_out_end' => $this->checkOutEnd,
            'holiday_1' => $this->holiday1,
            'holiday_2' => $this->holiday2,
            'time_zone' => $this->time_zone,
            'ip_address' => $this->ipAddress,
        ];

        return $properties;
    }

    public function resetFields()
    {
        $this->checkInStart = null;
    }
}
