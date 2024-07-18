<?php

namespace App\Services\Course;

use LaravelEasyRepository\BaseService;

interface CourseService extends BaseService
{
    /**
     * Get all course with limit
     * @param int|null $limit
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getCourses($limit = null);

    /**
     * Get all course schedules with limit
     * @param int|null $limit
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getCourseSchedules($limit = null);

    /**
     * Get course by ID with role and optional course details
     * @param int $courseId
     * @return \Illuminate\Database\Eloquent\Model|mixed
     * @throws \InvalidArgumentException
     */
    public function getCourseById($courseId);

    /**
     * Delete courses by given IDs
     * @param array|int $courseIds
     * @return void
     * @throws \InvalidArgumentException
     */
    public function deleteCourses($courseIds);

    /**
     * Get the data formatted for DataTables.
     */
    public function getCourseDatatables();

    /**
     * Get the data formatted for DataTables.
     */
    public function getCourseSchedulesDatatables();
}
