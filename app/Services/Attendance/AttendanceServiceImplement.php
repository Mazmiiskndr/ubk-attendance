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
     * Get the data formatted for DataTables for attendances by date.
     */
    public function getDatatablesStudentByDate()
    {
        return $this->handleRepositoryCall('getDatatablesStudentByDate');
    }

    /**
     * Get the data formatted for DataTables for attendances by week.
     */
    public function getDatatablesStudentByWeek()
    {
        return $this->handleRepositoryCall('getDatatablesStudentByWeek');
    }

    /**
     * Get the data formatted for DataTables for attendances by month.
     */
    public function getDatatablesStudentByMonth()
    {
        return $this->handleRepositoryCall('getDatatablesStudentByMonth');
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
}
