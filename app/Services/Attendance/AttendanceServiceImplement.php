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
     * Get all attendance with optional limit, user ID, date, and month
     * @param int|null $limit
     * @param int|null $userId
     * @param string|null $date
     * @param string|null $month
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAttendances($limit = null, $userId = null, $date = null, $month = null)
    {
        return $this->handleRepositoryCall('getAttendances', [$limit, $userId, $date, $month]);
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
    public function deleteCourses($attendanceIds)
    {
        return $this->handleRepositoryCall('deleteCourses', [$attendanceIds]);
    }
}
