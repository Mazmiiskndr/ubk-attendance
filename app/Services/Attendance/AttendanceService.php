<?php

namespace App\Services\Attendance;

use LaravelEasyRepository\BaseService;

interface AttendanceService extends BaseService
{
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
    public function getAttendances($limit = null, $userId = null, $date = null, $startOfWeek = null, $endOfWeek = null, $roleAlias = null);

    /**
     * Get attendance by ID
     * @param int $id
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function getAttendanceById($id);

    /**
     * Delete attendances by given IDs
     * @param array|int $attendanceIds
     * @return void
     * @throws \InvalidArgumentException
     */
    public function deleteAttendances($attendanceIds);

    /**
     * Count attendances within a given date range
     * @param string $startDate
     * @param string $endDate
     * @param int|null $userId
     * @return int
     */
    public function countAttendancesByDateRange($startDate, $endDate, $userId = null, $status = null);

    /**
     * Get attendance data per month with optional role alias filter
     * @param int $year
     * @param int $month
     * @param string|null $roleAlias
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getMonthlyAttendance($year, $month, $roleAlias = null);

    /**
     * Get filtered attendances
     * @param string $filter
     * @param string|null $roleAlias
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getFilteredAttendances($filter, $roleAlias = null);

    /**
     * Get the data formatted for DataTables for student by date.
     * @param string|null $date The date for which to get the attendance data. If null, defaults to today's date.
     */
    public function getDatatablesStudentByDate($date);

    /**
     * Get the data formatted for DataTables for attendances by week.
     *
     * @param array|null $dates An optional array containing 'startDate' and 'endDate'.
     */
    public function getDatatablesStudentByWeek($dates);

    /**
     * Get the data formatted for DataTables for attendances by month.
     *
     * @param array|null $dates An optional array containing 'startDate' and 'endDate'.
     */
    public function getDatatablesStudentByMonth($dates);

    /**
     * Get the data formatted for DataTables for lecture by date.
     */
    public function getDatatablesLectureByDate();

    /**
     * Get the data formatted for DataTables for attendances by week for lecture.
     */
    public function getDatatablesLectureByWeek();

    /**
     * Get the data formatted for DataTables for attendances by month for lecture.
     */
    public function getDatatablesLectureByMonth();

    /**
     * Get the validation rules for the form request.
     * @param string|null $attendanceId The user ID.
     * @return array The validation rules.
     */
    public function getValidationRules(?string $attendanceId = null);

    /**
     * Get the validation error messages for the form fields.
     * @return array The validation error messages.
     */
    public function getValidationErrorMessages();

    /**
     * Store or update a Attendance.
     *
     * @param array $data
     */
    public function storeOrUpdate($data);

    /**
     * Get the day of the week in Indonesian.
     *
     * @param string $date
     * @return string
     */
    public function getDay($date);

    /**
     * Check if the given user ID is valid.
     *
     * @param int $userId
     * @return bool
     */
    public function isValidUserId($userId);

    /**
     * Determine the attendance status based on user ID, date, and time.
     *
     * @param int $userId
     * @param string $date
     * @param string $time
     * @return string
     */
    public function determineStatus($userId, $date, $time);

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
    public function storeAttendanceData($userId, $date, $time, $status, $filename);
}
