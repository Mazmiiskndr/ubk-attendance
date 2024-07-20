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

    /**
     * Get the data formatted for DataTables.
     */
    public function getLectureDatatables()
    {
        return $this->handleRepositoryCall('getLectureDatatables');
    }

    /**
     * Get user by ID with role and optional user details
     * @param int $userId
     * @return \Illuminate\Database\Eloquent\Model|mixed
     * @throws \InvalidArgumentException
     */
    public function getUserById($userId)
    {
        return $this->handleRepositoryCall('getUserById', [$userId]);
    }

    /**
     * Get the validation rules for the form request.
     * @param string|null $userId The user ID.
     * @param string|null $roleAlias The user role alias.
     * @return array The validation rules.
     */
    public function getValidationRules(?string $userId = null, $roleAlias = null)
    {
        return $this->handleRepositoryCall('getValidationRules', [$userId, $roleAlias]);
    }

    /**
     * Get the validation error messages for the form fields.
     * @return array The validation error messages.
     */
    public function getValidationErrorMessages()
    {
        return $this->handleRepositoryCall('getValidationErrorMessages');
    }

    public function storeOrUpdateUser($data)
    {
        return $this->handleRepositoryCall('storeOrUpdateUser', [$data]);
    }
}
