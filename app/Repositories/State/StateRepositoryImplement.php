<?php

namespace App\Repositories\State;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\State;

class StateRepositoryImplement extends Eloquent implements StateRepository
{

    /**
     * Model class to be used in this repository for the common methods inside Eloquent
     * Don't remove or change $this->model variable name
     * @property State|mixed $stateModel;
     */
    protected $stateModel;

    public function __construct(State $stateModel)
    {
        $this->stateModel = $stateModel;
    }

    /**
     * Check the state with status '1' and return its details.
     *
     * @param string $key
     * @return string JSON encoded array
     */
    public function checkStateStatus(string $key)
    {
        if ($key === "x124sr3sQQ2d") {
            $state = $this->stateModel->where('status', 1)->first();

            if ($state) {
                $response = [
                    "status" => 0,
                    "id" => $state->id,
                ];
            } else {
                $response = [
                    "status" => 1,
                    "id" => '',
                ];
            }
        } else {
            $response = [
                "status" => 2,
                "id" => '',
            ];
        }

        return json_encode($response);
    }
}
