<?php

namespace App\Repositories\Attendance;

use App\Traits\{DataTablesTrait, ActionsButtonTrait};
use Carbon\Carbon;
use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Attendance;

class AttendanceRepositoryImplement extends Eloquent implements AttendanceRepository
{
    use DataTablesTrait, ActionsButtonTrait;
    /**
     * Model class to be used in this repository for the common methods inside Eloquent
     * Don't remove or change $this->model variable name
     * @property Attendance|mixed $attendanceModel;
     */
    protected $attendanceModel;

    public function __construct(Attendance $attendanceModel)
    {
        $this->attendanceModel = $attendanceModel;
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
        $query = $this->attendanceModel->with(['user', 'courseSchedule.course'])->latest();

        if ($userId !== null) {
            $query->where('user_id', $userId);
        }

        if ($date !== null) {
            $query->whereDate('attendance_date', $date);
        }

        if ($month !== null) {
            $query->whereMonth('attendance_date', Carbon::parse($month)->month);
        }

        if ($limit !== null) {
            $query->limit($limit);
        }

        return $query->get();
    }

    /**
     * Get attendance by ID
     * @param int $id
     * @return Attendance
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function getAttendanceById($id)
    {
        return $this->attendanceModel->with(['user', 'courseSchedule.course'])->findOrFail($id);
    }

    /**
     * Delete attendances by given IDs
     * @param array|int $attendanceIds
     * @return void
     * @throws \InvalidArgumentException
     */
    public function deleteAttendances($attendanceIds)
    {
        // Ensure $attendanceIds is an array
        $attendanceIds = is_array($attendanceIds) ? $attendanceIds : [$attendanceIds];

        // Fetch attendances by IDs
        $attendances = $this->attendanceModel->whereIn('id', $attendanceIds)->get();

        if ($attendances->isEmpty()) {
            throw new \InvalidArgumentException("Attendances with the given IDs cannot be found.");
        }

        // Delete the attendances
        $this->attendanceModel->whereIn('id', $attendanceIds)->delete();
    }

    /**
     * Get the data formatted for DataTables for course schedules.
     */
    public function getDatatablesByDate()
    {
        $today = Carbon::today()->toDateString();
        $data = $this->getAttendances(null, null, $today);
        // Return format the data for DataTables
        return $this->formatDataTablesResponse(
            $data,
            [
                'student' => function ($data) {
                    return $data->user ? $data->user->name : '-';
                },
                'action' => function ($data) {
                    $encodedId = base64_encode($data->id);
                    return $this->getActionButtons(
                        $encodedId,
                        'showAttendance',
                        // 'confirmDeleteCourse',
                        null,
                        'attendances.students.date.edit',
                        null,
                        'showDetail',
                        'attendances.students.date.show',
                        'link'
                    );

                }
            ]
        );
    }

    /**
     * Get the data formatted for DataTables for course schedules.
     */
    public function getDatatablesByMonth()
    {
        $month = Carbon::now()->format('Y-m');
        $data = $this->getAttendances(null, null, null, $month);
        // Return format the data for DataTables
        return $this->formatDataTablesResponse(
            $data,
            [
                'student' => function ($data) {
                    return $data->user ? $data->user->name : '-';
                },
                'action' => function ($data) {
                    $encodedId = base64_encode($data->id);
                    return $this->getActionButtons(
                        $encodedId,
                        'showAttendance',
                        // 'confirmDeleteCourse',
                        null,
                        'attendances.students.date.edit',
                        null,
                        'showDetail',
                        'attendances.students.date.show',
                        'link'
                    );

                }
            ]
        );
    }
}
