<?php

namespace App\Services\Attendance;

use LaravelEasyRepository\Service;
use App\Repositories\Attendance\AttendanceRepository;
use App\Traits\HandleRepositoryCall;

class AttendanceServiceImplement extends Service implements AttendanceService
{
    use HandleRepositoryCall;
    /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
    protected $mainRepository;

    public function __construct(AttendanceRepository $mainRepository)
    {
        $this->mainRepository = $mainRepository;
    }

    /**
     * Get all attendance with optional limit, user ID, date, start of week, end of week, and role alias
     * @param int|null $limit
     * @param int|null $userId
     * @param string|null $date
     * @param string|null $startOfWeek
     * @param string|null $endOfWeek
     * @param string|null $roleAlias
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAttendances($limit = null, $userId = null, $date = null, $startOfWeek = null, $endOfWeek = null, $roleAlias = null)
    {
        return $this->handleRepositoryCall('getAttendances', [$limit, $userId, $date, $startOfWeek, $endOfWeek, $roleAlias]);
    }

    /**
     * Get attendance by ID
     * @param int $id
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function getAttendanceById($id)
    {
        return $this->handleRepositoryCall('getAttendanceById', [$id]);
    }

    /**
     * Delete attendances by given IDs
     * @param array|int $attendanceIds
     * @return void
     * @throws \InvalidArgumentException
     */
    public function deleteAttendances($attendanceIds)
    {
        return $this->handleRepositoryCall('deleteCourses', [$attendanceIds]);
    }

    /**
     * Count attendances within a given date range
     * @param string $startDate
     * @param string $endDate
     * @return int
     */
    public function countAttendancesByDateRange($startDate, $endDate)
    {
        return $this->handleRepositoryCall('countAttendancesByDateRange', [$startDate, $endDate]);
    }

    /**
     * Get attendance data per month with optional role alias filter
     * @param int $year
     * @param int $month
     * @param string|null $roleAlias
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getMonthlyAttendance($year, $month, $roleAlias = null)
    {
        return $this->handleRepositoryCall('getMonthlyAttendance', [$year, $month, $roleAlias]);
    }

    /**
     * Get filtered attendances
     * @param string $filter
     * @param string|null $roleAlias
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getFilteredAttendances($filter, $roleAlias = null)
    {
        return $this->handleRepositoryCall('getFilteredAttendances', [$filter, $roleAlias]);
    }

    /**
     * Get the data formatted for DataTables for student by date.
     * @param string|null $date The date for which to get the attendance data. If null, defaults to today's date.
     */
    public function getDatatablesStudentByDate($date)
    {
        return $this->handleRepositoryCall('getDatatablesStudentByDate', [$date]);
    }

    /**
     * Get the data formatted for DataTables for attendances by week.
     *
     * @param array|null $dates An optional array containing 'startDate' and 'endDate'.
     */
    public function getDatatablesStudentByWeek($dates)
    {
        return $this->handleRepositoryCall('getDatatablesStudentByWeek', [$dates]);
    }

    /**
     * Get the data formatted for DataTables for attendances by month.
     *
     * @param array|null $dates An optional array containing 'startDate' and 'endDate'.
     */
    public function getDatatablesStudentByMonth($dates)
    {
        return $this->handleRepositoryCall('getDatatablesStudentByMonth', [$dates]);
    }

    /**
     * Get the data formatted for DataTables for lecture by date.
     */
    public function getDatatablesLectureByDate()
    {
        return $this->handleRepositoryCall('getDatatablesLectureByDate');
    }

    /**
     * Get the data formatted for DataTables for attendances by week for lecture.
     */
    public function getDatatablesLectureByWeek()
    {
        return $this->handleRepositoryCall('getDatatablesLectureByWeek');
    }

    /**
     * Get the data formatted for DataTables for attendances by month for lecture.
     */
    public function getDatatablesLectureByMonth()
    {
        return $this->handleRepositoryCall('getDatatablesLectureByMonth');
    }

    /**
     * Get the validation rules for the form request.
     * @param string|null $attendanceId The user ID.
     * @return array The validation rules.
     */
    public function getValidationRules(?string $attendanceId = null)
    {
        return $this->handleRepositoryCall('getValidationRules', [$attendanceId]);
    }

    /**
     * Get the validation error messages for the form fields.
     * @return array The validation error messages.
     */
    public function getValidationErrorMessages()
    {
        return $this->handleRepositoryCall('getValidationErrorMessages');
    }

    /**
     * Store or update a Attendance.
     *
     * @param array $data
     */
    public function storeOrUpdate($data)
    {
        return $this->handleRepositoryCall('storeOrUpdate', [$data]);
    }
}
