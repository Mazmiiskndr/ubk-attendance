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
     * @param int|null $userId
     * @param string|null $status
     * @param string|null $roleAlias
     * @return int
     */
    public function countAttendancesByDateRange($startDate, $endDate, $userId = null, $status = null, $roleAlias = null)
    {
        return $this->handleRepositoryCall('countAttendancesByDateRange', [$startDate, $endDate, $userId, $status, $roleAlias]);
    }
    /**
     * Get attendance data per month with optional role alias and user ID filter
     * @param int $year
     * @param int $month
     * @param string|null $roleAlias
     * @param int|null $userId
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getMonthlyAttendance($year, $month, $roleAlias = null, $userId = null)
    {
        return $this->handleRepositoryCall('getMonthlyAttendance', [$year, $month, $roleAlias, $userId]);
    }

    /**
     * Get filtered attendances with optional role alias and user ID filter
     * @param string $filter
     * @param string|null $roleAlias
     * @param int|null $userId
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getFilteredAttendances($filter, $roleAlias = null, $userId = null)
    {
        return $this->handleRepositoryCall('getFilteredAttendances', [$filter, $roleAlias, $userId]);
    }

    /**
     * Get the data formatted for DataTables for student by date.
     * @param string|null $date The date for which to get the attendance data. If null, defaults to today's date.
     * @param int|null $userId The ID of the user for which to get the attendance data. If null, uses the authenticated user's ID if they are a 'mahasiswa'.
     */
    public function getDatatablesStudentByDate($date = null, $userId = null)
    {
        return $this->handleRepositoryCall('getDatatablesStudentByDate', [$date, $userId]);
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
     * @param int|null $userId The ID of the user for which to get the attendance data. If null, uses the authenticated user's ID if they are a 'dosen'.
     */
    public function getDatatablesLectureByDate($userId = null)
    {
        return $this->handleRepositoryCall('getDatatablesLectureByDate', [$userId]);
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

    /**
     * Get the day of the week in Indonesian.
     *
     * @param string $date
     * @return string
     */
    public function getDay($date)
    {
        return $this->handleRepositoryCall('getDay', [$date]);
    }

    /**
     * Check if the given user ID is valid.
     *
     * @param int $userId
     * @return bool
     */
    public function isValidUserId($userId)
    {
        return $this->handleRepositoryCall('isValidUserId', [$userId]);
    }

    /**
     * Determine the attendance status based on user ID, date, and time.
     *
     * @param int $userId
     * @param string $date
     * @param string $time
     * @return string
     */
    public function determineStatus($userId, $date, $time)
    {
        return $this->handleRepositoryCall('determineStatus', [$userId, $date, $time]);
    }

    /**
     * Store attendance data in the database.
     *
     * @param int $userId
     * @param string $date
     * @param string $time
     * @param string $status
     * @param string $filename
     * @return string
     */
    public function storeAttendanceData($userId, $date, $time, $status, $filename)
    {
        return $this->handleRepositoryCall('storeAttendanceData', [$userId, $date, $time, $status, $filename]);
    }
}
