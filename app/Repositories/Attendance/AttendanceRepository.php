<?php

namespace App\Repositories\Attendance;

use LaravelEasyRepository\Repository;

interface AttendanceRepository extends Repository
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
    public function getAttendances($limit, $userId, $date, $startOfWeek, $endOfWeek, $roleAlias);

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
     * Get the data formatted for DataTables for attendances by date.
     */
    public function getDatatablesStudentByDate();

    /**
     * Get the data formatted for DataTables for attendances by week.
     */
    public function getDatatablesStudentByWeek();

    /**
     * Get the data formatted for DataTables for attendances by month.
     */
    public function getDatatablesStudentByMonth();

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
}
