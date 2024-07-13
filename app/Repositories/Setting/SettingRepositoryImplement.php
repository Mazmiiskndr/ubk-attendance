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
                $updated = \DB::table('settings')->update(['time_zone' => $data['time_zone']]);
                break;
            case 2:
                $updated = \DB::table('settings')->update(['bot_token' => $data['bot_token']]);
                break;
            case 3:
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
                'variable' => 'Zona Waktu',
                'parameter' => $settings->time_zone,
                'description' => 'Parameter zona waktu berdasarkan area',
                'action' => $this->getActionButtons(1, 'showSetting')
            ],
            [
                'variable' => 'Bot Token',
                'parameter' => $settings->bot_token,
                'description' => 'Parameter Token',
                'action' => $this->getActionButtons(2, 'showSetting')
            ],
            [
                'variable' => 'IP Address',
                'parameter' => $settings->ip_address,
                'description' => 'IP Address Kontroler',
                'action' => $this->getActionButtons(3, 'showSetting')
            ]
        ]);

        return $this->formatDataTablesResponse($data);
    }

    public function getValidationRules(?string $settingId = null)
    {
        switch ($settingId) {

            case 1:
                return ['timeZone' => 'required'];
            case 2:
                return ['botToken' => 'required'];
            case 3:
                return ['ipAddress' => 'required|ip'];
            default:
                return [];
        }

    }

    public function getValidationErrorMessages()
    {
        return [
            'timeZone.required' => 'Zona Waktu tidak boleh kosong!',
            'botToken.required' => 'Mulai jam masuk tidak boleh kosong!',
            'ipAddress.required' => 'IP Address tidak boleh kosong!',
            'ipAddress.ip' => 'IP Address harus format yang valid!'
        ];
    }
}
