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

    // Write something awesome :)
}
