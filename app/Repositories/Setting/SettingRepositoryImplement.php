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
        $query = $this->settingModel->latest();
        if ($limit !== null) {
            $query->limit($limit);
        }

        // Fetch the latest settings
        $settings = $query->get();

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
        // Retrieve the category resumes data from the resume model
        $data = $this->getSettings();

        // Return format the data for DataTables
        return $this->formatDataTablesResponse(
            $data,
            [
                'created_at' => function ($data) {
                    return date('d-F-Y', strtotime($data->created_at));
                },
                'action' => function ($data) {
                    return $this->getActionButtons($data->id, 'showSetting', 'confirmDeleteSetting');
                }
            ]
        );
    }
}
