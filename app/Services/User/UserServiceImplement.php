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
     * Count users with optional role alias, status, and gender
     * @param string|null $roleAlias
     * @param int|null $status
     * @param string|null $gender
     * @return int
     * @throws \InvalidArgumentException
     */
    public function countUsers($roleAlias = null, $status = null, $gender = null)
    {
        return $this->handleRepositoryCall('countUsers', [$roleAlias, $status, $gender]);
    }

    /**
     * Delete users by given IDs
     * @param array|int $userIds
     * @return void
     * @throws \InvalidArgumentException
     */
    public function deleteUsers($userIds)
    {
        return $this->handleRepositoryCall('deleteUsers', [$userIds]);
    }

    /**
     * Get the data formatted for DataTables.
     */
    public function getStudentDatatables()
    {
        return $this->handleRepositoryCall('getStudentDatatables');
    }
}
