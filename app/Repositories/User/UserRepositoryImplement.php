<?php

namespace App\Repositories\User;

use App\Models\State;
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
    protected $userDetailModel;
    protected $stateModel;

    public function __construct(User $userModel, Role $roleModel, UserDetail $userDetailModel, State $stateModel)
    {
        $this->userModel = $userModel;
        $this->roleModel = $roleModel;
        $this->userDetailModel = $userDetailModel;
        $this->stateModel = $stateModel;
    }

    /**
     * Get all users with optional role alias and limit
     * @param string|null $roleAlias
     * @param int|null $limit
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getUsers($roleAlias = null, $limit = null)
    {
        $query = $this->userModel->with(['role', 'userDetail.kelas'])->latest();

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
     * Get the latest state for a given user or all states if no user ID is provided.
     * @param int|null $userId
     * @return State|null
     * @throws \InvalidArgumentException If no state is found and the user ID is provided.
     */
    public function getStates($userId = null)
    {
        $query = $this->stateModel->query();

        if ($userId !== null) {
            $query->where('user_id', $userId);
        }

        // Filter untuk hanya mengambil data dengan controller_notes yang tidak kosong
        $query->whereNotNull('controller_notes')->where('controller_notes', '!=', '');

        // Ambil satu data terbaru
        $state = $query->latest()->first();

        // Cek apakah data ditemukan atau tidak
        if ($state === null && $userId !== null) {
            throw new \InvalidArgumentException("States data cannot be found for user ID: $userId.");
        }

        return $state;
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
     * Get the data formatted for DataTables.
     */
    public function getLectureDatatables()
    {
        // Retrieve the groups data from the group model
        $data = $this->getUsers("dosen", null);
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
                        'showLecture',
                        'confirmDeleteLecture',
                        'backend.lecture.edit',
                        'link',
                        'showDetail',
                        'backend.lecture.show',
                        'link'
                    );

                }
            ]
        );
    }

    /**
     * Get the validation rules for the form request.
     * @param string|null $userId The user ID.
     * @param string|null $roleAlias The user role alias.
     * @return array The validation rules.
     */
    public function getValidationRules(?string $userId = null, $roleAlias = null): array
    {
        $identNumberRule = 'required|numeric|unique:user_details,ident_number';
        $emailRule = 'required|email|max:100|unique:users,email';

        if ($userId !== null) {
            $emailRule .= ",$userId,id";
            $identNumberRule .= ",$userId,user_id";
        }

        // Initialize base rules
        $rules = [
            'name' => 'required|min:1',
            'identNumber' => $identNumberRule,
            'email' => $emailRule,
            'phoneNumber' => 'required|numeric|digits_between:10,15',
            'gender' => 'required',
            'birthDate' => 'required|date',
            'images' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'address' => 'required|max:255',
        ];

        // Add additional rules for non-dosen roles
        if ($roleAlias !== 'dosen') {
            $rules['semester'] = 'required|integer|min:1';
            $rules['classId'] = 'required|min:1';
        }

        return $rules;
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
            'classId.required' => 'Kelas tidak boleh kosong!',
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
     * @param string $roleAlias
     * @return User
     */
    public function storeOrUpdateUser($data, $roleAlias = 'mahasiswa')
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
                'role_id' => $this->getRoleIdByName($roleAlias), // Set role based on roleAlias
            ]
        );

        // Prepare the data for user detail
        $userDetailData = [
            'gender' => $data['gender'],
            'ident_number' => $data['identNumber'],
            'phone_number' => $data['phoneNumber'],
            'birthdate' => $data['birthDate'],
            'address' => $data['address'],
        ];

        // Add semester and classId only if role is mahasiswa
        if ($roleAlias === 'mahasiswa') {
            $userDetailData['semester'] = $data['semester'];
            $userDetailData['class_id'] = $data['classId'];
        }

        // Create or update the user detail
        $this->userDetailModel->updateOrCreate(
            ['user_id' => $user->id],
            $userDetailData
        );

        return $user;
    }

    /**
     * Delete all data form table states
     * @return bool
     */
    public function truncateStates()
    {
        return $this->stateModel->truncate();
    }

    /**
     * Store or update a state.
     * @param array $data
     * @param string $roleAlias
     */
    public function storeOrUpdateState($data)
    {
        // Create or update the user
        $state = $this->stateModel->updateOrCreate(
            ['user_id' => $data['userId'] ?? null],
            [
                'status' => $data['status'],
                'controller_notes' => $data['controllerNotes'] ?? '',
            ]
        );

        return $state;
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
