<?php

namespace App\Repositories\Course;

use LaravelEasyRepository\Repository;

interface CourseRepository extends Repository
{
    /**
     * Get all course with limit
     * @param int|null $limit
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getCourses($limit);

    /**
     * Get all course schedules with limit
     * @param int|null $limit
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getCourseSchedules($limit);

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
