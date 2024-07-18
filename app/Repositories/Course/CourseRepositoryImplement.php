<?php

namespace App\Repositories\Course;

use App\Models\CourseSchedule;
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
    protected $courseScheduleModel;

    public function __construct(Course $courseModel, CourseSchedule $courseScheduleModel)
    {
        $this->courseModel = $courseModel;
        $this->courseScheduleModel = $courseScheduleModel;
    }

    /**
     * Get all course with limit
     * @param int|null $limit
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getCourses($limit = null)
    {
        $query = $this->courseModel->with(['lecturer', 'schedules'])->latest();

        // if ($roleAlias !== null) {
        //     $role = $this->roleModel->where('name_alias', $roleAlias)->first();

        //     if ($role) {
        //         $query->where('role_id', $role->id);
        //     } else {
        //         throw new \InvalidArgumentException("Role with alias '{$roleAlias}' cannot be found.");
        //     }
        // }

        if ($limit !== null) {
            $query->limit($limit);
        }

        $courses = $query->get();

        if ($courses->isEmpty()) {
            throw new \InvalidArgumentException("Courses Data cannot be found.");
        }

        return $courses;
    }

    /**
     * Get all course schedules with limit and optional course ID
     * @param int|null $courseId
     * @param int|null $limit
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getCourseSchedules($courseId = null, $limit = null)
    {
        $query = $this->courseScheduleModel->with(['course.lecturer'])->latest();

        if ($courseId !== null) {
            $query->where('course_id', $courseId);
        }

        if ($limit !== null) {
            $query->limit($limit);
        }

        $schedules = $query->get();

        if ($schedules->isEmpty()) {
            throw new \InvalidArgumentException("Course Schedules Data cannot be found.");
        }

        return $schedules;
    }

    /**
     * Get course by ID with role and optional course details
     * @param int $courseId
     * @return \Illuminate\Database\Eloquent\Model|mixed
     * @throws \InvalidArgumentException
     */
    public function getCourseById($courseId)
    {
        $course = $this->courseModel->with(['lecturer', 'schedules'])->find($courseId);

        if (!$course) {
            throw new \InvalidArgumentException("Course with ID {$courseId} cannot be found.");
        }

        return $course;
    }


    /**
     * Delete courses by given IDs
     * @param array|int $courseIds
     * @return void
     * @throws \InvalidArgumentException
     */
    public function deleteCourses($courseIds)
    {
        // Ensure $courseIds is an array
        $courseIds = is_array($courseIds) ? $courseIds : [$courseIds];

        // Fetch courses by IDs
        $courses = $this->courseModel->whereIn('id', $courseIds)->get();

        if ($courses->isEmpty()) {
            throw new \InvalidArgumentException("Courses with the given IDs cannot be found.");
        }

        // Delete the courses
        $this->courseModel->whereIn('id', $courseIds)->delete();
    }

    /**
     * Get the data formatted for DataTables for course schedules.
     */
    public function getCourseDatatables()
    {
        // Retrieve the groups data from the group model
        $data = $this->getCourses();
        // Return format the data for DataTables
        return $this->formatDataTablesResponse(
            $data,
            [
                'lecturer' => function ($data) {
                    return $data->lecturer ? $data->lecturer->name : '-';
                },
                'action' => function ($data) {
                    $encodedId = base64_encode($data->id);
                    return $this->getActionButtons(
                        $encodedId,
                        'showCourse',
                        'confirmDeleteCourse',
                        'backend.course.edit',
                        'link',
                        'showDetail',
                        'backend.course.show',
                        'link'
                    );

                }
            ]
        );
    }

    /**
     * Get the data formatted for DataTables for course schedules.
     * @param int|null $courseId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCourseSchedulesDatatables($courseId = null)
    {
        // Retrieve the groups data from the group model
        $data = $this->getCourseSchedules($courseId);
        // Return format the data for DataTables
        return $this->formatDataTablesResponse(
            $data,
            [
                'action' => function ($data) {
                    $encodedId = base64_encode($data->id);
                    return $this->getActionButtons(
                        $encodedId,
                        'showCourse',
                        'confirmDeleteCourse',
                        'backend.course.edit',
                        'link'
                    );

                }
            ]
        );
    }
}
