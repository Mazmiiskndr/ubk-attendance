<?php

namespace App\Livewire\Forms\Backend\Student;

use App\Services\User\UserService;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Livewire\WithFileUploads;

class CreateForm extends Form
{
    use WithFileUploads;
    /**
     * The properties of a user object.
     */
    public $name, $identNumber, $email, $phoneNumber, $gender, $birthDate, $semester, $class, $images, $address;

    /**
     * Get the validation rules for the model.
     * @return array
     */
    public function rules()
    {
        $userService = app(UserService::class);
        return $userService->getValidationRules();
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
        if ($this->images) {
            $filePath = $this->images->store('public/assets/images/users');
            $validated['images'] = basename($filePath); // Get only the filename
        } else {
            $validated['images'] = 'default.png'; // Default image
        }
        // Attempt to create the new user
        $user = $userService->storeOrUpdateUser($validated);
        // Reset the form for the next user
        $this->reset();
        return $user;
    }
}
