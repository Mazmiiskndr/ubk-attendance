<?php

namespace App\Services\Attendance;

use LaravelEasyRepository\BaseService;

interface AttendanceService extends BaseService
{
    /**
     * Get all attendance with optional limit, user ID, date, and month
     * @param int|null $limit
     * @param int|null $userId
     * @param string|null $date
     * @param string|null $month
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAttendances($limit = null, $userId = null, $date = null, $month = null);

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
     * Get the data formatted for DataTables for course schedules.
     */
    public function getDatatablesByDate();

    /**
     * Get the data formatted for DataTables for course schedules.
     */
    public function getDatatablesByMonth();
}
