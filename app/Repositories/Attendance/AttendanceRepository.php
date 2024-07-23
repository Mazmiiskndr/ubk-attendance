<?php

namespace App\Repositories\Attendance;

use LaravelEasyRepository\Repository;

interface AttendanceRepository extends Repository
{
    /**
     * Get all attendance with optional limit, user ID, date, and month
     * @param int|null $limit
     * @param int|null $userId
     * @param string|null $date
     * @param string|null $month
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAttendances($limit, $userId, $date, $month);

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
    public function deleteCourses($attendanceIds);
}
