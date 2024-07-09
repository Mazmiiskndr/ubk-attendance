<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function students()
    {
        return view('pages.backend.users.students');
    }

    public function lecturers()
    {
        return view('pages.backend.users.lecturers');
    }
}
