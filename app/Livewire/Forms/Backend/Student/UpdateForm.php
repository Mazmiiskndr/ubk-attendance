<?php

namespace App\Livewire\Forms\Backend\Student;

use App\Services\User\UserService;
use Illuminate\Validation\ValidationException;
use Livewire\Form;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class UpdateForm extends Form
{
    use WithFileUploads;
    /**
     * The properties of a user object.
     */
    public $name, $identNumber, $email, $phoneNumber, $gender, $birthDate, $semester, $classId, $images, $address, $idStudent, $existingImage;

    public function setStudent($student)
    {
        $this->idStudent = $student->id;
        $this->name = $student->name;
        $this->identNumber = $student->userDetail->ident_number ?? '';
        $this->email = $student->email;
        $this->phoneNumber = $student->userDetail->phone_number ?? '';
        $this->gender = $student->userDetail->gender ?? '';
        $this->birthDate = $student->userDetail->birthdate ?? '';
        $this->semester = $student->userDetail->semester ?? '';
        $this->classId = $student->userDetail->kelas->id ?? '';
        $this->address = $student->userDetail->address ?? '';
        $this->existingImage = $student->images;
    }

    /**
     * Get the validation rules for the model.
     * @return array
     */
    public function rules()
    {
        $userService = app(UserService::class);
        return $userService->getValidationRules($this->idStudent);
    }

    /**
     * Get the validation error messages from the user service.
     * @return array
     */
    public function messages()
    {
        $userService = app(UserService::class);
        return $userService->getValidationErrorMessages();
    }

    /**
     * Store Or Update a new user.
     * @param UserService $userService User service instance
     */
    public function storeOrUpdate(UserService $userService)
    {
        // Validate form fields
        $validated = $this->validate();
        // Handle file upload
        if ($this->images && $this->images->isValid()) {
            // Hapus gambar sebelumnya kecuali jika default.png
            if ($this->existingImage !== 'default.png' && Storage::exists('public/assets/images/users/' . $this->existingImage)) {
                Storage::delete('public/assets/images/users/' . $this->existingImage);
            }
            $filePath = $this->images->store('public/assets/images/users');
            $validated['images'] = basename($filePath); // Get only the filename
        } else {
            $validated['images'] = $this->existingImage; // Default image
        }
        // Sertakan idStudent dalam data yang divalidasi
        $validated['id'] = $this->idStudent;

        // Coba buat atau perbarui pengguna
        $user = $userService->storeOrUpdateUser($validated);
        // Reset the form for the next user
        $this->reset();
        return $user;
    }
}
