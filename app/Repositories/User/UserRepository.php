<?php

namespace App\Repositories\User;

use LaravelEasyRepository\Repository;

interface UserRepository extends Repository
{
    /**
     * Get all users with optional role alias and limit
     * @param string|null $roleAlias
     * @param int|null $limit
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getUsers($roleAlias, $limit);

    /**
     * Get the data formatted for DataTables.
     */
    public function getStudentDatatables();

    /**
     * Count users with optional role alias, status, and gender
     * @param string|null $roleAlias
     * @param int|null $status
     * @param string|null $gender
     * @return int
     * @throws \InvalidArgumentException
     */
    public function countUsers($roleAlias, $status, $gender);

    /**
     * Delete users by given IDs
     * @param array|int $userIds
     * @return void
     * @throws \InvalidArgumentException
     */
    public function deleteUsers($userIds);

    /**
     * Get user by ID with role and optional user details
     * @param int $userId
     * @return \Illuminate\Database\Eloquent\Model|mixed
     * @throws \InvalidArgumentException
     */
    public function getUserById($userId);

    /**
     * Get the validation rules for the form request.
     * @param string|null $userId The user ID.
     * @return array The validation rules.
     */
    public function getValidationRules(?string $userId);

    /**
     * Get the validation error messages for the form fields.
     * @return array The validation error messages.
     */
    public function getValidationErrorMessages();

    public function storeOrUpdateUser($data);
}
