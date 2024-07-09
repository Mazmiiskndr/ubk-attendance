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
}
