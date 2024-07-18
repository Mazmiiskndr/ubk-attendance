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

  /**
   * Get all course with limit
   * @param int|null $limit
   * @return \Illuminate\Database\Eloquent\Collection|static[]
   */
  public function getCourses($limit = null)
  {
    return $this->handleRepositoryCall('getCourses', [$limit]);
  }

  /**
   * Get all course schedules with limit and optional course ID
   * @param int|null $courseId
   * @param int|null $limit
   * @return \Illuminate\Database\Eloquent\Collection|static[]
   */
  public function getCourseSchedules($courseId = null, $limit = null)
  {
    return $this->handleRepositoryCall('getCourseSchedules', [$courseId, $limit]);
  }

  /**
   * Get course by ID with role and optional course details
   * @param int $courseId
   * @return \Illuminate\Database\Eloquent\Model|mixed
   * @throws \InvalidArgumentException
   */
  public function getCourseById($courseId)
  {
    return $this->handleRepositoryCall('getCourseById', [$courseId]);
  }

  /**
   * Delete courses by given IDs
   * @param array|int $courseIds
   * @return void
   * @throws \InvalidArgumentException
   */
  public function deleteCourses($courseIds)
  {
    return $this->handleRepositoryCall('deleteCourses', [$courseIds]);
  }

  /**
   * Get the data formatted for DataTables.
   */
  public function getCourseDatatables()
  {
    return $this->handleRepositoryCall('getCourseDatatables');
  }

  /**
   * Get the data formatted for DataTables for course schedules.
   * @param int|null $courseId
   * @return \Illuminate\Http\JsonResponse
   */
  public function getCourseSchedulesDatatables($courseId = null)
  {
    return $this->handleRepositoryCall('getCourseSchedulesDatatables', [$courseId]);
  }

}
