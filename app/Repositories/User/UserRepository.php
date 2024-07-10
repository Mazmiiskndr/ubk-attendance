<?php

namespace App\Repositories\User;

use LaravelEasyRepository\Repository;

interface UserRepository extends Repository
{
    /**
     * Get all users
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getUsers($limit);
}
