<?php

namespace App\Services\Setting;

use LaravelEasyRepository\BaseService;

interface SettingService extends BaseService
{
    /**
     * Get all settings
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getSettings($limit = null);

    /**
     * Get the data formatted for DataTables.
     */
    public function getDatatables();
}
