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
     * Get all attendance with optional limit, user ID, date, start of week, and end of week
     * @param int|null $limit
     * @param int|null $userId
     * @param string|null $date
     * @param string|null $startOfWeek
     * @param string|null $endOfWeek
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAttendances($limit = null, $userId = null, $date = null, $startOfWeek = null, $endOfWeek = null)
    {
        return $this->handleRepositoryCall('getAttendances', [$limit, $userId, $date, $startOfWeek, $endOfWeek]);
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
     * Get the data formatted for DataTables for attendances by date.
     */
    public function getDatatablesByDate()
    {
        return $this->handleRepositoryCall('getDatatablesByDate');
    }

    /**
     * Get the data formatted for DataTables for attendances by week.
     */
    public function getDatatablesByWeek()
    {
        return $this->handleRepositoryCall('getDatatablesByWeek');
    }

    /**
     * Get the data formatted for DataTables for attendances by month.
     */
    public function getDatatablesByMonth()
    {
        return $this->handleRepositoryCall('getDatatablesByMonth');
    }
}
