<?php

namespace App\Repositories\Setting;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Setting;
use App\Traits\{ActionsButtonTrait, DataTablesTrait};

class SettingRepositoryImplement extends Eloquent implements SettingRepository
{
    use DataTablesTrait, ActionsButtonTrait;
    /**
     * Model class to be used in this repository for the common methods inside Eloquent
     * Don't remove or change $this->model variable name
     * @property Setting|mixed $settingModel;
     */
    protected $settingModel;

    public function __construct(Setting $settingModel)
    {
        $this->settingModel = $settingModel;
    }

    /**
     * Get all settings
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getSettings($limit = null)
    {
        // If the limit is set, use the 'take' method to take a limited number of settings
        $query = $this->settingModel;
        if ($limit !== null) {
            $query->limit($limit);
        }

        // Fetch the latest settings
        $settings = $query->first();

        // If no settings are found, throw an exception
        if (!$settings) {
            throw new \InvalidArgumentException("Settings Data cannot be not found.");
        }

        // Return the retrieved settings
        return $settings;
    }

    public function updateSetting($data)
    {
        $settingId = $data['setting_id'];

        $updated = false;

        switch ($settingId) {
            case 1:
                $updated = \DB::table('settings')->update(['check_in_start' => $data['check_in_start']]);
                break;
            case 2:
                $updated = \DB::table('settings')->update(['check_in_end' => $data['check_in_end']]);
                break;
            case 3:
                $updated = \DB::table('settings')->update(['check_out_start' => $data['check_out_start']]);
                break;
            case 4:
                $updated = \DB::table('settings')->update(['check_out_end' => $data['check_out_end']]);
                break;
            case 5:
                $updated = \DB::table('settings')->update(['holiday_1' => $data['holiday_1']]);
                break;
            case 6:
                $updated = \DB::table('settings')->update(['holiday_2' => $data['holiday_2']]);
                break;
            case 7:
                $updated = \DB::table('settings')->update(['time_zone' => $data['time_zone']]);
                break;
            case 8:
                $updated = \DB::table('settings')->update(['ip_address' => $data['ip_address']]);
                break;
            default:
                throw new \Exception("Invalid setting ID");
        }

        return $updated;
    }

    /**
     * Get the data formatted for DataTables.
     */
    public function getDatatables()
    {
        $settings = $this->getSettings(); // Assuming there's only one record

        $data = collect([
            [
                'variable' => 'Mulai jam masuk',
                'parameter' => $settings->check_in_start,
                'description' => 'Parameter jam akan dimulai presensi masuk',
                'action' => $this->getActionButtons(1, 'showSetting')
            ],
            [
                'variable' => 'Akhir jam masuk',
                'parameter' => $settings->check_in_end,
                'description' => 'Batas dari Parameter jam presensi masuk',
                'action' => $this->getActionButtons(2, 'showSetting')
            ],
            [
                'variable' => 'Mulai jam keluar',
                'parameter' => $settings->check_out_start,
                'description' => 'Parameter jam akan dimulai presensi keluar / pulang',
                'action' => $this->getActionButtons(3, 'showSetting')
            ],
            [
                'variable' => 'Akhir jam keluar',
                'parameter' => $settings->check_out_end,
                'description' => 'Batas dari parameter jam presensi keluar / pulang',
                'action' => $this->getActionButtons(4, 'showSetting')
            ],
            [
                'variable' => 'Hari Libur 1',
                'parameter' => $settings->holiday_1,
                'description' => 'Jika parameter ini diset pada hari tersebut presensi tidak berjalan',
                'action' => $this->getActionButtons(5, 'showSetting')
            ],
            [
                'variable' => 'Hari Libur 2',
                'parameter' => $settings->holiday_2,
                'description' => 'Jika parameter ini diset pada hari tersebut presensi tidak berjalan',
                'action' => $this->getActionButtons(6, 'showSetting')
            ],
            [
                'variable' => 'Zona Waktu',
                'parameter' => $settings->time_zone,
                'description' => 'Parameter zona waktu berdasarkan area',
                'action' => $this->getActionButtons(7, 'showSetting')
            ],
            [
                'variable' => 'IP Address',
                'parameter' => $settings->ip_address,
                'description' => 'IP Address Kontroler',
                'action' => $this->getActionButtons(8, 'showSetting')
            ]
        ]);

        return $this->formatDataTablesResponse($data);
    }

    public function getValidationRules(?string $settingId = null)
    {
        switch ($settingId) {
            case 1:
                return ['checkInStart' => 'required|date_format:H:i:s'];
            case 2:
                return ['checkInEnd' => 'required|date_format:H:i:s'];
            case 3:
                return ['checkOutStart' => 'required|date_format:H:i:s'];
            case 4:
                return ['checkOutEnd' => 'required|date_format:H:i:s'];
            case 5:
                return ['holiday1' => 'required'];
            case 6:
                return ['holiday2' => 'required'];
            case 7:
                return ['timeZone' => 'required'];
            case 8:
                return ['ipAddress' => 'required|ip'];
            default:
                return [];
        }

    }

    public function getValidationErrorMessages()
    {
        return [
            'checkInStart.required' => 'Mulai jam masuk tidak boleh kosong!',
            'checkInStart.date_format' => 'Mulai jam masuk harus dalam format HH:MM:SS!',
            'checkInEnd.required' => 'Akhir jam masuk tidak boleh kosong!',
            'checkInEnd.date_format' => 'Akhir jam masuk harus dalam format HH:MM:SS!',
            'checkOutStart.required' => 'Mulai jam keluar tidak boleh kosong!',
            'checkOutStart.date_format' => 'Mulai jam keluar harus dalam format HH:MM:SS!',
            'checkOutEnd.required' => 'Akhir jam keluar tidak boleh kosong!',
            'checkOutEnd.date_format' => 'Akhir jam keluar harus dalam format HH:MM:SS!',
            'holiday1.required' => 'Hari Libur 1 tidak boleh kosong!',
            'holiday2.required' => 'Hari Libur 2 tidak boleh kosong!',
            'timeZone.required' => 'Zona Waktu tidak boleh kosong!',
            'ipAddress.required' => 'IP Address tidak boleh kosong!',
            'ipAddress.ip' => 'IP Address harus format yang valid!'
        ];
    }
}
