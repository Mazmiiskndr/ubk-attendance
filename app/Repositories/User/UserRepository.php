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
}
