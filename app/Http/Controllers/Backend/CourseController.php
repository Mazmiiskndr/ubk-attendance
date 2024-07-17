<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        return view('pages.backend.courses.index');
    }
    public function show()
    {
        dd("TODO:");
        // return view('pages.backend.courses.index');
    }
    public function edit()
    {
        dd("TODO:");
    }
}
