<?php

namespace App\Repositories\State;

use LaravelEasyRepository\Repository;

interface StateRepository extends Repository
{
    /**
     * Check the state with status '1' and return its details.
     *
     * @param string $key
     * @return string JSON encoded array
     */
    public function checkStateStatus(string $key);
}
