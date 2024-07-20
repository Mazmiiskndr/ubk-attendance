<?php

namespace App\Services\User;

use LaravelEasyRepository\BaseService;

interface UserService extends BaseService
{
    /**
     * Get all users with optional role alias and limit
     * @param string|null $roleAlias
     * @param int|null $limit
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getUsers($roleAlias = null, $limit = null);

    /**
     * Get the data formatted for DataTables.
     */
    public function getStudentDatatables();

    /**
     * Get the data formatted for DataTables.
     */
    public function getLectureDatatables();

    /**
     * Count users with optional role alias, status, and gender
     * @param string|null $roleAlias
     * @param int|null $status
     * @param string|null $gender
     * @return int
     * @throws \InvalidArgumentException
     */
    public function countUsers($roleAlias = null, $status = null, $gender = null);

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
     * @param string|null $roleAlias The user role alias.
     * @return array The validation rules.
     */
    public function getValidationRules(?string $userId = null, $roleAlias = null);

    /**
     * Get the validation error messages for the form fields.
     * @return array The validation error messages.
     */
    public function getValidationErrorMessages();

    /**
     * Store or update a user.
     *
     * @param array $data
     * @param string $roleAlias
     */
    public function storeOrUpdateUser($data, $roleAlias = 'mahasiswa');
}
