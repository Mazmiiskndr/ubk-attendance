<?php

namespace App\Repositories\Setting;

use LaravelEasyRepository\Repository;

interface SettingRepository extends Repository
{
    /**
     * Get all settings
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getSettings($limit);

    /**
     * Get the data formatted for DataTables.
     */
    public function getDatatables();
}
