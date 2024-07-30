<?php

namespace App\Repositories\Course;

use App\Models\CourseSchedule;
use App\Traits\{DataTablesTrait, ActionsButtonTrait};
use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Course;
use App\Enums\DayOfWeek;
use Illuminate\Validation\Rules\Enum;

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
     * Get all courses with optional limit, lecture ID, and class ID
     * @param int|null $limit
     * @param int|null $lectureId
     * @param int|null $classId
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getCourses($limit = null, $lectureId = null, $classId = null)
    {
        $query = $this->courseModel->with(['lecturer', 'schedules', 'kelas'])->latest();

        if ($lectureId !== null) {
            $query->where('lecturer_id', $lectureId);
        }

        if ($classId !== null) {
            $query->where('class_id', $classId);
        }

        if ($limit !== null) {
            $query->limit($limit);
        }

        $courses = $query->get();

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
        $query = $this->courseScheduleModel->with(['course.lecturer', 'course.kelas'])->latest();

        if ($courseId !== null) {
            $query->where('course_id', $courseId);
        }

        if ($limit !== null) {
            $query->limit($limit);
        }

        $schedules = $query->get();


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
        $course = $this->courseModel->with(['lecturer', 'schedules', 'kelas'])->find($courseId);

        if (!$course) {
            throw new \InvalidArgumentException("Course with ID {$courseId} cannot be found.");
        }

        return $course;
    }

    /**
     * Get course schedule by ID with role and optional course details
     * @param int $courseScheduleId
     * @return \Illuminate\Database\Eloquent\Model|mixed
     * @throws \InvalidArgumentException
     */
    public function getCourseScheduleById($courseScheduleId)
    {
        $courseSchedule = $this->courseScheduleModel->with(['course.lecturer', 'course.kelas'])->find($courseScheduleId);

        if (!$courseSchedule) {
            throw new \InvalidArgumentException("Course Schedules ID {$courseScheduleId} cannot be found.");
        }

        return $courseSchedule;
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
     * Delete course Schedule by given IDs
     * @param array|int $courseScheduleIds
     * @return void
     * @throws \InvalidArgumentException
     */
    public function deleteCourseSchedules($courseScheduleIds)
    {
        // Ensure $courseScheduleIds is an array
        $courseScheduleIds = is_array($courseScheduleIds) ? $courseScheduleIds : [$courseScheduleIds];
        // Fetch courses by IDs
        $courseSchedules = $this->courseScheduleModel->whereIn('id', $courseScheduleIds)->get();

        if ($courseSchedules->isEmpty()) {
            throw new \InvalidArgumentException("Course Schedules with the given IDs cannot be found.");
        }

        // Delete the courses
        $this->courseScheduleModel->whereIn('id', $courseScheduleIds)->delete();
    }

    /**
     * Get the data formatted for DataTables for course schedules.
     */
    public function getCourseDatatables()
    {
        $lectureId = auth()->user()->id;
        $roleAlias = auth()->user()->role->name_alias;

        // Retrieve the courses data from the course model
        if ($roleAlias == 'dosen') {
            $data = $this->getCourses(null, $lectureId);
        } else {
            $data = $this->getCourses();
        }
        // Return format the data for DataTables
        return $this->formatDataTablesResponse(
            $data,
            [
                'lecturer' => function ($data) {
                    return $data->lecturer ? $data->lecturer->name : '-';
                },
                'kelas' => function ($data) {
                    return $data->kelas ? $data->kelas->name . '/' . $data->kelas->room : '-';
                },
                'action' => function ($data) {
                    $encodedId = base64_encode($data->id);
                    return $this->getActionButtons(
                        $encodedId,
                        'showCourse',
                        'confirmDeleteCourse',
                        'backend.course.edit',
                        null,
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
        if ($data->isEmpty()) {
            return datatables()->of(collect())->make(true);
        }
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
                    );

                }
            ]
        );
    }

    /**
     * Get the validation rules for the form request.
     * @param string|null $scheduleId The user ID.
     * @return array The validation rules.
     */
    public function getValidationScheduleRules(?string $scheduleId = null): array
    {
        return [
            'checkInStart' => 'required|date_format:H:i',
            'checkInEnd' => 'required|date_format:H:i',
            'checkOutStart' => 'required|date_format:H:i',
            'checkOutEnd' => 'required|date_format:H:i',
            'day' => ['required', new Enum(DayOfWeek::class)],
        ];
    }

    /**
     * Get the validation error messages for the form fields.
     * @return array The validation error messages.
     */
    public function getValidationScheduleErrorMessages(): array
    {
        return [
            'checkInStart.required' => 'Mulai Jam Masuk tidak boleh kosong!',
            'checkInStart.date_format' => 'Format Mulai Jam Masuk harus HH:MM!',
            'checkInEnd.required' => 'Akhir Jam Masuk tidak boleh kosong!',
            'checkInEnd.date_format' => 'Format Akhir Jam Masuk harus HH:MM!',
            'checkOutStart.required' => 'Mulai Jam Keluar tidak boleh kosong!',
            'checkOutStart.date_format' => 'Format Mulai Jam Keluar harus HH:MM!',
            'checkOutEnd.required' => 'Akhir Jam Keluar tidak boleh kosong!',
            'checkOutEnd.date_format' => 'Format Akhir Jam Keluar harus HH:MM!',
            'day.required' => 'Hari tidak boleh kosong!',
            'day.Enum' => 'Hari harus merupakan salah satu dari: Senin, Selasa, Rabu, Kamis, Jumat, Sabtu, Minggu!',
        ];
    }

    /**
     * Get the validation rules for the form request.
     * @param string|null $courseId The user ID.
     * @return array The validation rules.
     */
    public function getValidationCourseRules(?string $courseId = null): array
    {
        return [
            'name' => 'required',
            'lecturerId' => 'required',
            'classId' => 'required',
        ];
    }

    /**
     * Get the validation error messages for the form fields.
     * @return array The validation error messages.
     */
    public function getValidationCourseErrorMessages(): array
    {
        return [
            'name.required' => 'Nama Mata Kuliah tidak boleh kosong!',
            'lecturerId.required' => 'Nama Dosen tidak boleh kosong!',
            'classId.required' => 'Nama Kelas tidak boleh kosong!',
        ];
    }

    /**
     * Store or update a Schedule.
     *
     * @param array $data
     * @return CourseSchedule
     */
    public function storeOrUpdateSchedule($data)
    {
        // Create or update the schedule
        $schedule = $this->courseScheduleModel->updateOrCreate(
            ['id' => $data['id'] ?? null],
            [
                'course_id' => $data['courseId'],
                'check_in_start' => $data['checkInStart'],
                'check_in_end' => $data['checkInEnd'],
                'check_out_start' => $data['checkOutStart'],
                'check_out_end' => $data['checkOutEnd'],
                'day' => $data['day'],
            ]
        );
        return $schedule;
    }

    /**
     * Store or update a Course.
     *
     * @param array $data
     * @return CourseSchedule
     */
    public function storeOrUpdateCourse($data)
    {
        // Create or update the course
        $course = $this->courseModel->updateOrCreate(
            ['id' => $data['id'] ?? null],
            [
                'name' => $data['name'],
                'lecturer_id' => $data['lecturerId'],
                'class_id' => $data['classId'],
            ]
        );
        return $course;
    }

    /**
     * Get the data formatted for DataTables for course schedules.
     */
    public function getStudentCourseScheduleDatatables()
    {
        $userDetail = auth()->user()->userDetail;

        if ($userDetail) {
            $classId = $userDetail->class_id;
        } else {
            $classId = null;
        }

        // Retrieve the courses data from the course model
        $data = $this->getCourses(null, null, $classId);

        // Return format the data for DataTables
        return $this->formatDataTablesResponse(
            $data,
            [
                'lecturer' => function ($data) {
                    return $data->lecturer ? $data->lecturer->name : '-';
                },
                'room' => function ($data) {
                    return $data->kelas ? $data->kelas->room : '-';
                },
                'action' => function ($data) {
                    $encodedId = base64_encode($data->id);
                    return $this->getActionButtons(
                        $encodedId,
                        null,
                        null,
                        null,
                        null,
                        'showDetail',
                        'backend.student-course-schedules.show',
                        'link'
                    );

                }
            ]
        );
    }

    /**
     * Get the data formatted for DataTables for course schedules.
     * @param int|null $courseId
     */
    public function getShowStudentCourseScheduleDatatables($courseId = null)
    {
        // Retrieve the groups data from the group model
        $data = $this->getCourseSchedules($courseId);
        if ($data->isEmpty()) {
            return datatables()->of(collect())->make(true);
        }
        // Return format the data for DataTables
        return $this->formatDataTablesResponse($data);
    }
}
