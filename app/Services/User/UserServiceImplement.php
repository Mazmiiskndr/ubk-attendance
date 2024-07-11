<?php

namespace App\Services\User;

use LaravelEasyRepository\Service;
use App\Repositories\User\UserRepository;
use App\Traits\HandleRepositoryCall;

class UserServiceImplement extends Service implements UserService
{
    use HandleRepositoryCall;

    /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
    protected $mainRepository;

    public function __construct(UserRepository $mainRepository)
    {
        $this->mainRepository = $mainRepository;
    }

    /**
     * Get all users with optional role alias and limit
     * @param string|null $roleAlias
     * @param int|null $limit
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getUsers($roleAlias = null, $limit = null)
    {
        return $this->handleRepositoryCall('getUsers', [$roleAlias, $limit]);
    }

    /**
     * Get the data formatted for DataTables.
     */
    public function getStudentDatatables()
    {
        return $this->handleRepositoryCall('getStudentDatatables');
    }
}
