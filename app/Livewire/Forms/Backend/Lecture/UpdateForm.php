<?php

namespace App\Livewire\Forms\Backend\Lecture;

use App\Services\User\UserService;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class UpdateForm extends Form
{
    use WithFileUploads;
    /**
     * The properties of a user object.
     */
    public $name, $identNumber, $email, $phoneNumber, $gender, $birthDate, $images, $address, $idLecture, $existingImage;

    public function setLecture($lecture)
    {
        $this->idLecture = $lecture->id;
        $this->name = $lecture->name;
        $this->identNumber = $lecture->userDetail->ident_number;
        $this->email = $lecture->email;
        $this->phoneNumber = $lecture->userDetail->phone_number;
        $this->gender = $lecture->userDetail->gender;
        $this->birthDate = $lecture->userDetail->birthdate;
        $this->address = $lecture->userDetail->address;
        $this->existingImage = $lecture->images;
    }

    /**
     * Get the validation rules for the model.
     * @return array
     */
    public function rules()
    {
        $userService = app(UserService::class);
        return $userService->getValidationRules($this->idLecture, 'dosen');
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
        // Sertakan idLecture dalam data yang divalidasi
        $validated['id'] = $this->idLecture;

        // Coba buat atau perbarui pengguna
        $user = $userService->storeOrUpdateUser($validated, 'dosen');
        // Reset the form for the next user
        $this->reset();
        return $user;
    }
}
