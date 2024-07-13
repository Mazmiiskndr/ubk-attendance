<?php

namespace App\Services\Setting;

use LaravelEasyRepository\Service;
use App\Repositories\Setting\SettingRepository;
use App\Traits\HandleRepositoryCall;

class SettingServiceImplement extends Service implements SettingService
{
    use HandleRepositoryCall;
    /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
    protected $mainRepository;

    public function __construct(SettingRepository $mainRepository)
    {
        $this->mainRepository = $mainRepository;
    }

    /**
     * Get all settings
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getSettings($limit = null)
    {
        return $this->handleRepositoryCall('getSettings', [$limit]);
    }

    /**
     * Get the data formatted for DataTables.
     */
    public function getDatatables()
    {
        return $this->handleRepositoryCall('getDatatables');
    }

    public function getValidationRules(?string $settingId = null)
    {
        return $this->handleRepositoryCall('getValidationRules', [$settingId]);
    }

    public function getValidationErrorMessages()
    {
        return $this->handleRepositoryCall('getValidationErrorMessages');
    }

    public function updateSetting($data)
    {
        return $this->handleRepositoryCall('updateSetting', [$data]);
    }
}
