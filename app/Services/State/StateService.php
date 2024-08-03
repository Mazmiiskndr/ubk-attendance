<?php

namespace App\Services\State;

use LaravelEasyRepository\BaseService;

interface StateService extends BaseService
{
    /**
     * Check the state with status '1' and return its details.
     *
     * @param string $key
     * @return string JSON encoded array
     */
    public function checkStateStatus(string $key);
}
