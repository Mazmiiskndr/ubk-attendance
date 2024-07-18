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
     * Get all course schedules with limit and optional course ID
     * @param int|null $courseId
     * @param int|null $limit
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getCourseSchedules($courseId, $limit);

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
     * Delete course Schedule by given IDs
     * @param array|int $courseScheduleIds
     * @return void
     * @throws \InvalidArgumentException
     */
    public function deleteCourseSchedules($courseScheduleIds);

    /**
     * Get the data formatted for DataTables.
     */
    public function getCourseDatatables();

    /**
     * Get the data formatted for DataTables for course schedules.
     * @param int|null $courseId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCourseSchedulesDatatables($courseId);

    /**
     * Get the validation rules for the form request.
     * @param string|null $scheduleId The user ID.
     * @return array The validation rules.
     */
    public function getValidationScheduleRules(?string $scheduleId);

    /**
     * Get the validation error messages for the form fields.
     * @return array The validation error messages.
     */
    public function getValidationScheduleErrorMessages();

    /**
     * Store or update a CourseSchedule.
     *
     * @param array $data
     */
    public function storeOrUpdateSchedule($data);
}
