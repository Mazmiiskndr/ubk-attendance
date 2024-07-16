<?php

namespace App\Repositories\User;

use App\Models\UserDetail;
use App\Traits\{ActionsButtonTrait, DataTablesTrait};
use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\{User, Role};
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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
    protected $userDetailMOdel;

    public function __construct(User $userModel, Role $roleModel, UserDetail $userDetailMOdel)
    {
        $this->userModel = $userModel;
        $this->roleModel = $roleModel;
        $this->userDetailMOdel = $userDetailMOdel;
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
                        'backend.student.edit',
                        'link',
                        'showDetail',
                        'backend.student.show',
                        'link'
                    );

                }
            ]
        );
    }

    /**
     * Get the validation rules for the form request.
     * @param string|null $userId The user ID.
     * @return array The validation rules.
     */
    public function getValidationRules(?string $userId = null): array
    {
        // Initialize password rule based on userId
        $passwordRule = $userId ? 'nullable|min:6|confirmed' : 'required|min:6|confirmed';

        // Username and Email rules for unique validation
        $emailRule = 'required|email|max:100|unique:users,email';
        // $usernameRule = 'required|min:5|max:32|regex:/^\S*$/u|unique:users,username';

        if ($userId !== null) {
            // $usernameRule .= ",$userId,id";
            $emailRule .= ",$userId,id";
        }

        return [
            'name' => 'required|min:1',
            'identNumber' => 'required|numeric|unique:user_details,ident_number',
            'email' => $emailRule,
            'phoneNumber' => 'required|numeric|digits_between:10,15',
            'gender' => 'required',
            'birthDate' => 'required|date',
            'semester' => 'required|integer|min:1',
            'images' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'address' => 'required|max:255',
            // 'username' => $usernameRule,
            // 'password' => $passwordRule
        ];
    }

    /**
     * Get the validation error messages for the form fields.
     * @return array The validation error messages.
     */
    public function getValidationErrorMessages(): array
    {
        return [
            'name.required' => 'Nama tidak boleh kosong!',
            'name.min' => 'Nama harus terdiri dari minimal 1 karakter!',
            'identNumber.required' => 'NIM tidak boleh kosong!',
            'identNumber.numeric' => 'NIM harus berupa angka!',
            'identNumber.unique' => 'NIM sudah terdaftar!',
            'email.required' => 'Email tidak boleh kosong!',
            'email.email' => 'Alamat Email harus berupa email yang valid!',
            'email.max' => 'Alamat Email tidak boleh lebih dari 100 karakter!',
            'email.unique' => 'Alamat Email sudah terdaftar!',
            'phoneNumber.required' => 'Nomor Telepon tidak boleh kosong!',
            'phoneNumber.numeric' => 'Nomor Telepon harus berupa angka!',
            'phoneNumber.digits_between' => 'Nomor Telepon harus terdiri dari 10 hingga 15 digit!',
            'gender.required' => 'Jenis Kelamin tidak boleh kosong!',
            'birthDate.required' => 'Tanggal Lahir tidak boleh kosong!',
            'birthDate.date' => 'Tanggal Lahir harus berupa tanggal yang valid!',
            'semester.required' => 'Semester tidak boleh kosong!',
            'semester.integer' => 'Semester harus berupa angka!',
            'semester.min' => 'Semester tidak boleh kurang dari 1!',
            'images.image' => 'Berkas harus berupa gambar!',
            'images.mimes' => 'Gambar harus berformat: jpeg, png, jpg, gif!',
            'images.max' => 'Ukuran gambar tidak boleh lebih dari 5MB!',
            'address.required' => 'Alamat tidak boleh kosong!',
            'address.max' => 'Alamat tidak boleh lebih dari 255 karakter!',
            // 'password.required' => 'Kata Sandi tidak boleh kosong!',
            // 'password.min' => 'Kata Sandi harus terdiri dari minimal 6 karakter!',
            // 'password.confirmed' => 'Kata Sandi dan Konfirmasi Kata Sandi harus cocok!',
        ];
    }

    /**
     * Store or update a user.
     *
     * @param array $data
     * @return User
     */
    public function storeOrUpdateUser($data)
    {
        // Create or update the user
        $user = $this->userModel->updateOrCreate(
            ['id' => $data['id'] ?? null],
            [
                'name' => $data['name'],
                'username' => $data['identNumber'], // Assuming identNumber is used as username
                'email' => $data['email'],
                'images' => $data['images'] ?? 'default.png', // Default image is 'default.png
                'password' => Hash::make($data['identNumber']), // Default password is identNumber
                'status' => 1, // You can change the default status as needed
                'role_id' => $this->getRoleIdByName('mahasiswa'), // Set role as mahasiswa
            ]
        );

        // Create or update the user detail
        $this->userDetailMOdel->updateOrCreate(
            ['user_id' => $user->id],
            [
                'gender' => $data['gender'],
                'ident_number' => $data['identNumber'],
                'position' => $data['semester'], // Use semester as position
                'phone_number' => $data['phoneNumber'],
                'birthdate' => $data['birthDate'],
                'address' => $data['address'],
            ]
        );

        return $user;
    }

    /**
     * Get role ID by role name.
     *
     * @param string $roleName
     * @return int
     */
    protected function getRoleIdByName(string $roleName): int
    {
        return $this->roleModel->where('name_alias', $roleName)->firstOrFail()->id;
    }
}
