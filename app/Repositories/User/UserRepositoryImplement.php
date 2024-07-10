<?php

namespace App\Repositories\User;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\User;

class UserRepositoryImplement extends Eloquent implements UserRepository
{

    /**
     * Model class to be used in this repository for the common methods inside Eloquent
     * Don't remove or change $this->model variable name
     * @property User|mixed $userModel;
     */
    protected $userModel;

    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }

    /**
     * Get all users
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getUsers($limit = null)
    {
        // If the limit is set, use the 'take' method to take a limited number of users
        $query = $this->userModel->latest();
        if ($limit !== null) {
            $query->limit($limit);
        }

        // Fetch the latest users
        $users = $query->get();

        // If no users are found, throw an exception
        if (!$users) {
            throw new \InvalidArgumentException("Users Data cannot be not found.");
        }

        // Return the retrieved users
        return $users;
    }
}
