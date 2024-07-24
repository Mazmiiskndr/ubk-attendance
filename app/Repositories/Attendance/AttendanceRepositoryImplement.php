<?php

namespace App\Repositories\Attendance;

use App\Enums\AttendanceStatus;
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
        $query = $this->attendanceModel->with(['user', 'courseSchedule.course'])->latest();

        if ($userId !== null) {
            $query->where('user_id', $userId);
        }

        if ($date !== null) {
            $query->whereDate('attendance_date', $date);
        }

        if ($startOfWeek !== null && $endOfWeek !== null) {
            $query->whereBetween('attendance_date', [$startOfWeek, $endOfWeek]);
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
        if ($data->isEmpty()) {
            return datatables()->of(collect())->make(true);
        }
        // Return format the data for DataTables
        return $this->formatDataTablesResponse(
            $data,
            [
                'check_in' => function ($data) {
                    return $data->check_in ?? '-';
                },
                'check_out' => function ($data) {
                    return $data->check_out ?? '-';
                },
                'attendance_date' => function ($data) {
                    return date("Y-m-d", strtotime($data->attendance_date)) ?? '-';
                },
                'status' => function ($data) {
                    $status = AttendanceStatus::from($data->status);
                    $labelClass = match ($status) {
                        AttendanceStatus::Hadir => 'bg-success',
                        AttendanceStatus::Sakit => 'bg-warning',
                        AttendanceStatus::Izin => 'bg-info',
                        AttendanceStatus::Terlambat => 'bg-secondary',
                        AttendanceStatus::Alpha => 'bg-danger',
                    };
                    return '<span class="badge ' . $labelClass . '">' . $status->name . '</span>';
                },
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
                        'backend.attendances.students.date.edit',
                        null,
                        'showDetail',
                        'backend.attendances.students.date.show',
                        'link'
                    );
                }
            ]
        );
    }

    /**
     * Get the data formatted for DataTables for attendances by month.
     */
    public function getDatatablesByWeek()
    {
        $startOfWeek = Carbon::now()->startOfWeek()->format('Y-m-d');
        $endOfWeek = Carbon::now()->endOfWeek()->format('Y-m-d');
        $groupedData = $this->getAttendances(null, null, null, $startOfWeek, $endOfWeek)->groupBy('user_id');
        if ($groupedData->isEmpty()) {
            return datatables()->of(collect())->make(true);
        }
        $daysInWeek = 7;
        $formattedData = $groupedData->map(function ($attendances, $userId) use ($daysInWeek, $startOfWeek) {
            $user = $attendances->first()->user;
            $row = [
                'student' => $user->name,
                'id' => $user->id,
                'A' => 0,
                'T' => 0,
                'S' => 0,
                'I' => 0,
                'H' => 0,
            ];

            for ($i = 0; $i < $daysInWeek; $i++) {
                $day = Carbon::parse($startOfWeek)->addDays($i)->format('Y-m-d');
                $attendance = $attendances->filter(function ($att) use ($day) {
                    return Carbon::parse($att->attendance_date)->format('Y-m-d') === $day;
                })->first();
                $status = $attendance ? $attendance->status : 'A';

                $row["day_" . ($i + 1)] = $status;
                // Increment the count for each status
                switch ($status) {
                    case 'A':
                        $row['A']++;
                        break;
                    case 'T':
                        $row['T']++;
                        break;
                    case 'S':
                        $row['S']++;
                        break;
                    case 'I':
                        $row['I']++;
                        break;
                    case 'H':
                        $row['H']++;
                        break;
                    default:
                        $row['A']++;
                        break;
                }
            }

            return $row;
        })->values();

        // Return format the data for DataTables
        return $this->formatDataTablesResponse(
            $formattedData,
            [
                'student' => function ($data) {
                    return $data['student'];
                },
                'id' => function ($data) {
                    return $data['id'];
                },
                ...array_map(function ($day) {
                    return function ($data) use ($day) {
                        return $data["day_$day"];
                    };
                }, range(1, $daysInWeek)),
                'A' => function ($data) {
                    return $data['A'];
                },
                'T' => function ($data) {
                    return $data['T'];
                },
                'S' => function ($data) {
                    return $data['S'];
                },
                'I' => function ($data) {
                    return $data['I'];
                },
                'H' => function ($data) {
                    return $data['H'];
                },
                'action' => function ($data) {
                    $encodedId = base64_encode($data['id']);
                    return $this->getActionButtons(
                        $encodedId,
                        'showAttendance',
                        null,
                        'backend.attendances.students.date.edit',
                        null,
                        'showDetail',
                        'backend.attendances.students.date.show',
                        'link'
                    );
                }
            ]
        );
    }



}
