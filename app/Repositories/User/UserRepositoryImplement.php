<?php

namespace App\Repositories\User;

use App\Traits\{ActionsButtonTrait, DataTablesTrait};
use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\{User, Role};

class UserRepositoryImplement extends Eloquent implements UserRepository
{
    use DataTablesTrait, ActionsButtonTrait;
    /**
     * Model class to be used in this repository for the common methods inside Eloquent
     * Don't remove or change $this->model variable name
     * @property User|mixed $userModel;
     */
    protected $userModel;
    protected $roleModel;

    public function __construct(User $userModel, Role $roleModel)
    {
        $this->userModel = $userModel;
        $this->roleModel = $roleModel;
    }

    /**
     * Get all users with optional role alias and limit
     * @param string|null $roleAlias
     * @param int|null $limit
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getUsers($roleAlias = null, $limit = null)
    {
        $query = $this->userModel->with(['role', 'userDetail'])->latest();

        if ($roleAlias !== null) {
            $role = $this->roleModel->where('name_alias', $roleAlias)->first();

            if ($role) {
                $query->where('role_id', $role->id);
            } else {
                throw new \InvalidArgumentException("Role with alias '{$roleAlias}' cannot be found.");
            }
        }

        if ($limit !== null) {
            $query->limit($limit);
        }

        $users = $query->get();

        if ($users->isEmpty()) {
            throw new \InvalidArgumentException("Users Data cannot be found.");
        }

        return $users;
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
        $query = $this->userModel->query();

        if ($roleAlias !== null) {
            $role = $this->roleModel->where('name_alias', $roleAlias)->first();

            if ($role) {
                $query->where('role_id', $role->id);
            } else {
                throw new \InvalidArgumentException("Role with alias '{$roleAlias}' cannot be found.");
            }
        }

        if ($status !== null) {
            $query->where('status', $status);
        }

        if ($gender !== null) {
            $query->whereHas('userDetail', function ($q) use ($gender) {
                $q->where('gender', $gender);
            });
        }

        $count = $query->count();

        if ($count === 0) {
            throw new \InvalidArgumentException("No users found matching the criteria.");
        }

        return $count;
    }

    /**
     * Delete users by given IDs
     * @param array|int $userIds
     * @return void
     * @throws \InvalidArgumentException
     */
    public function deleteUsers($userIds)
    {
        // Ensure $userIds is an array
        $userIds = is_array($userIds) ? $userIds : [$userIds];

        // Fetch users by IDs
        $users = $this->userModel->whereIn('id', $userIds)->get();

        if ($users->isEmpty()) {
            throw new \InvalidArgumentException("Users with the given IDs cannot be found.");
        }

        // Delete the users
        $this->userModel->whereIn('id', $userIds)->delete();
    }

    /**
     * Get user by ID with role and optional user details
     * @param int $userId
     * @return \Illuminate\Database\Eloquent\Model|mixed
     * @throws \InvalidArgumentException
     */
    public function getUserById($userId)
    {
        $user = $this->userModel->with(['role', 'userDetail'])->find($userId);

        if (!$user) {
            throw new \InvalidArgumentException("User with ID {$userId} cannot be found.");
        }

        return $user;
    }

    /**
     * Get the data formatted for DataTables.
     */
    public function getStudentDatatables()
    {
        // Retrieve the groups data from the group model
        $data = $this->getUsers("mahasiswa", null);
        // Return format the data for DataTables
        return $this->formatDataTablesResponse(
            $data,
            [
                'status' => function ($data) {
                    $status = $data->status == 1 ? 'Aktif' : 'Tidak Aktif';
                    $labelClass = $data->status == 1 ? 'bg-label-success' : 'bg-label-danger';
                    return '<span class="badge ' . $labelClass . '">' . $status . '</span>';
                },
                'ident_number' => function ($data) {
                    return $data->userDetail ? $data->userDetail->ident_number : '-';
                },
                'gender' => function ($data) {
                    return $data->userDetail ? $data->userDetail->gender : '-';
                },
                'phone_number' => function ($data) {
                    return $data->userDetail ? $data->userDetail->phone_number : '-';
                },
                'created_at' => function ($data) {
                    return date('d-M-Y H:i', strtotime($data->created_at));
                },
                'action' => function ($data) {
                    $encodedId = base64_encode($data->id);
                    return $this->getActionButtons(
                        $encodedId,
                        'showStudent',
                        'confirmDeleteStudent',
                        null,
                        'button',
                        'showDetail',
                        'backend.student.show',
                        'link'
                    );

                }
            ]
        );
    }
}
