<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\User\UserService;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function students()
    {
        return view('pages.backend.users.students');
    }

    public function lecturers()
    {
        return view('pages.backend.users.lecturers');
    }

    public function showStudent($encodedId)
    {
        try {
            $id = base64_decode($encodedId);
            if (!$id) {
                throw new \InvalidArgumentException("Invalid ID provided.");
            }

            $student = $this->userService->getUserById($id);
            return view('pages.backend.users.show-student', compact('student'));
        } catch (\InvalidArgumentException $e) {
            // Handle the exception, for example by redirecting back with an error message
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function editStudent($encodedId)
    {
        try {
            $id = base64_decode($encodedId);
            if (!$id) {
                throw new \InvalidArgumentException("Invalid ID provided.");
            }

            $student = $this->userService->getUserById($id);
            return view('pages.backend.users.edit-student', compact('student'));
        } catch (\InvalidArgumentException $e) {
            // Handle the exception, for example by redirecting back with an error message
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function create()
    {
        return view('pages.backend.users.student-create');
    }

}
