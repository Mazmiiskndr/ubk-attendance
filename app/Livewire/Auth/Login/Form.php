<?php

namespace App\Livewire\Auth\Login;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Form extends Component
{
    // Declare public variables for username and password
    public $username, $password;

    // Define an array of validation rules for the variables
    protected $rules = [
        'username' => 'required', // The username is required
        'password' => 'required', // The password is required
    ];

    // Define an array of custom error messages for validation failures
    protected $messages = [
        'username.required' => 'Username is required!', // Error message if the username is not provided
        'password.required' => 'Password is required!', // Error message if the password is not provided
    ];

    /**
     * Update the specified property and validate it.
     * @param string $property
     * @return void
     */
    public function updated($property)
    {
        // Every time a property changes
        // (only `text` for now), validate it
        $this->validateOnly($property);
    }

    public function render()
    {
        return view('livewire.auth.login.form');
    }

    public function loginAction()
    {
        // Validate the form input fields
        $this->validate();

        try {
            // Attempt to authenticate the user with the given credentials
            if (Auth::attempt(['username' => $this->username, 'password' => $this->password])) {
                // If the validation was successful and the user is authenticated
                if (Auth::check()) {
                    // Redirect the user to the desired page with a success message
                    session()->flash('success', "Great job! You've successfully logged in. Let's get started!");
                    return redirect()->route('backend.dashboard');
                }
            }

            // If authentication fails, check if the username exists
            $userExists = User::where('username', $this->username)->exists();
            if (!$userExists) {
                // If the username does not exist, flash a specific error message
                session()->flash('error', "The username you entered does not exist. Please try again.");
            } else {
                // If the username exists but the password is incorrect, flash a generic error message
                session()->flash('error', "Invalid Username or Password. Please try again.");
            }

            // Redirect back to the login page
            return redirect()->route('login');
        } catch (\Exception $e) {
            // If there's an exception, log it for debugging
            // Log::error('An error occurred during admin authentication: ' . $e->getMessage());

            // Flash a general error message
            session()->flash('error', 'An error occurred: ' . $e->getMessage());
            return redirect()->route('login');
        }
    }
}
