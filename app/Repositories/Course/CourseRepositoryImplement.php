<?php

namespace App\Repositories\Course;

use App\Traits\{DataTablesTrait, ActionsButtonTrait};
use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Course;

class CourseRepositoryImplement extends Eloquent implements CourseRepository
{
    use DataTablesTrait, ActionsButtonTrait;
    /**
     * Model class to be used in this repository for the common methods inside Eloquent
     * Don't remove or change $this->model variable name
     * @property Course|mixed $courseModel;
     */
    protected $courseModel;

    public function __construct(Course $courseModel)
    {
        $this->courseModel = $courseModel;
    }

    // Write something awesome :)
}
