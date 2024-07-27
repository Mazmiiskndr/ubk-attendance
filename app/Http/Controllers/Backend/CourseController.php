<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\Course\CourseService;

class CourseController extends Controller
{
    protected $courseService;

    public function __construct(CourseService $courseService)
    {
        $this->courseService = $courseService;
    }

    public function index()
    {
        return view('pages.backend.courses.index');
    }
    public function show($encodedId)
    {
        try {
            $id = base64_decode($encodedId);
            if (!$id) {
                throw new \InvalidArgumentException("Invalid ID provided.");
            }

            $course = $this->courseService->getCourseById($id);
            return view('pages.backend.courses.show', compact('course'));
        } catch (\InvalidArgumentException $e) {
            // Handle the exception, for example by redirecting back with an error message
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit()
    {
        dd("TODO:");
    }

    public function editSchedule()
    {
        dd("TODO:");
    }
}
