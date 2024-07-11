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
        $query = $this->userModel->latest();

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
                'nim' => function ($data) {
                    return $data->userDetail ? $data->userDetail->nim : '-';
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
                    return $this->getActionButtons(
                        $data->id,
                        'showStudent',
                        'deleteStudent',
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
