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
   * Get all courses with optional limit, lecture ID, and class ID
   * @param int|null $limit
   * @param int|null $lectureId
   * @param int|null $classId
   * @return \Illuminate\Database\Eloquent\Collection|static[]
   */
  public function getCourses($limit = null, $lectureId = null, $classId = null)
  {
    return $this->handleRepositoryCall('getCourses', [$limit, $lectureId, $classId]);
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
   * Get course schedule by ID with role and optional course details
   * @param int $courseScheduleId
   * @return \Illuminate\Database\Eloquent\Model|mixed
   * @throws \InvalidArgumentException
   */
  public function getCourseScheduleById($courseScheduleId)
  {
    return $this->handleRepositoryCall('getCourseScheduleById', [$courseScheduleId]);
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
   * Delete course Schedule by given IDs
   * @param array|int $courseScheduleIds
   * @return void
   * @throws \InvalidArgumentException
   */
  public function deleteCourseSchedules($courseScheduleIds)
  {
    return $this->handleRepositoryCall('deleteCourseSchedules', [$courseScheduleIds]);
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

  /**
   * Get the validation rules for the form request.
   * @param string|null $scheduleId The user ID.
   * @return array The validation rules.
   */
  public function getValidationScheduleRules(?string $scheduleId = null)
  {
    return $this->handleRepositoryCall('getValidationScheduleRules', [$scheduleId]);
  }

  /**
   * Get the validation error messages for the form fields.
   * @return array The validation error messages.
   */
  public function getValidationScheduleErrorMessages()
  {
    return $this->handleRepositoryCall('getValidationScheduleErrorMessages');
  }

  /**
   * Store or update a CourseSchedule.
   *
   * @param array $data
   */
  public function storeOrUpdateSchedule($data)
  {
    return $this->handleRepositoryCall('storeOrUpdateSchedule', [$data]);
  }

  /**
   * Get the validation rules for the form request.
   * @param string|null $courseId The user ID.
   * @return array The validation rules.
   */
  public function getValidationCourseRules(?string $courseId = null)
  {
    return $this->handleRepositoryCall('getValidationCourseRules', [$courseId]);
  }

  /**
   * Get the validation error messages for the form fields.
   * @return array The validation error messages.
   */
  public function getValidationCourseErrorMessages()
  {
    return $this->handleRepositoryCall('getValidationCourseErrorMessages');
  }

  /**
   * Store or update a Course.
   *
   * @param array $data
   */
  public function storeOrUpdateCourse($data)
  {
    return $this->handleRepositoryCall('storeOrUpdateCourse', [$data]);
  }

  /**
   * Get the data formatted for DataTables for course schedules.
   */
  public function getStudentCourseScheduleDatatables()
  {
    return $this->handleRepositoryCall('getStudentCourseScheduleDatatables');
  }

}
