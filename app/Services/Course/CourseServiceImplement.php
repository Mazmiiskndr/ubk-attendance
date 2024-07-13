<?php

namespace App\Services\Course;

use App\Traits\HandleRepositoryCall;
use LaravelEasyRepository\Service;
use App\Repositories\Course\CourseRepository;

class CourseServiceImplement extends Service implements CourseService
{
  use HandleRepositoryCall;
  /**
   * don't change $this->mainRepository variable name
   * because used in extends service class
   */
  protected $mainRepository;

  public function __construct(CourseRepository $mainRepository)
  {
    $this->mainRepository = $mainRepository;
  }

  // Define your custom methods :)
}
