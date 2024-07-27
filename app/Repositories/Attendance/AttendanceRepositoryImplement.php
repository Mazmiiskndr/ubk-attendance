<?php

namespace App\Repositories\Attendance;

use App\Enums\AttendanceStatus;
use App\Traits\{DataTablesTrait, ActionsButtonTrait};
use Carbon\Carbon;
use Illuminate\Validation\Rules\Enum;
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

        if ($roleAlias !== null) {
            $query->whereHas('user.role', function ($query) use ($roleAlias) {
                $query->where('name_alias', $roleAlias);
            });
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
     * Count attendances within a given date range
     * @param string $startDate
     * @param string $endDate
     * @return int
     */
    public function countAttendancesByDateRange($startDate, $endDate)
    {
        return $this->attendanceModel
            ->whereBetween('attendance_date', [$startDate, $endDate])
            ->count();
    }

    /**
     * Get attendance data per month with optional role alias filter
     * @param int $year
     * @param int $month
     * @param string|null $roleAlias
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getMonthlyAttendance($year, $month, $roleAlias = null)
    {
        $query = $this->attendanceModel
            ->whereYear('attendance_date', $year)
            ->whereMonth('attendance_date', $month);

        if ($roleAlias !== null) {
            $query->whereHas('user.role', function ($query) use ($roleAlias) {
                $query->where('name_alias', $roleAlias);
            });
        }

        return $query->get();
    }

    /**
     * Get filtered attendances
     * @param string $filter
     * @param string|null $roleAlias
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getFilteredAttendances($filter, $roleAlias = null)
    {
        $query = $this->attendanceModel->with(['user', 'courseSchedule.course'])->latest();
        $year = now()->year;
        $month = now()->month;

        switch ($filter) {
            case 'today':
                $date = now()->toDateString();
                $query->whereDate('attendance_date', $date);
                break;
            case 'yesterday':
                $date = now()->subDay()->toDateString();
                $query->whereDate('attendance_date', $date);
                break;
            case 'last7Days':
                $startDate = now()->subDays(7)->toDateString();
                $endDate = now()->toDateString();
                $query->whereBetween('attendance_date', [$startDate, $endDate]);
                break;
            case 'last30Days':
                $startDate = now()->subDays(30)->toDateString();
                $endDate = now()->toDateString();
                $query->whereBetween('attendance_date', [$startDate, $endDate]);
                break;
            case 'lastMonth':
                $startDate = now()->subMonth()->startOfMonth()->toDateString();
                $endDate = now()->subMonth()->endOfMonth()->toDateString();
                $query->whereBetween('attendance_date', [$startDate, $endDate]);
                break;
            case 'currentMonth':
            default:
                $query->whereYear('attendance_date', $year)
                    ->whereMonth('attendance_date', $month);
                break;
        }

        if ($roleAlias !== null) {
            $query->whereHas('user.role', function ($query) use ($roleAlias) {
                $query->where('name_alias', $roleAlias);
            });
        }

        return $query->get();
    }

    /**
     * Get the data formatted for DataTables for student by date.
     * @param string|null $date The date for which to get the attendance data. If null, defaults to today's date.
     */
    public function getDatatablesStudentByDate($date = null)
    {
        $today = Carbon::today()->toDateString();
        $selectedDate = $date ? $date : $today;
        $currentUser = auth()->user();
        $userId = null;
        if ($currentUser->role->name_alias == 'mahasiswa') {
            $userId = $currentUser->id;
        }

        $data = $this->getAttendances(null, $userId, $selectedDate, null, null, 'mahasiswa');
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
                        (auth()->user()->role->name_alias == 'dosen' || auth()->user()->role->name_alias == 'admin') ? 'showAttendance' : null,
                        null,
                        (auth()->user()->role->name_alias == 'dosen' || auth()->user()->role->name_alias == 'admin') ? 'backend.attendances.students.date.edit' : null,
                    );
                }
            ]
        );
    }

    /**
     * Get the data formatted for DataTables for attendances by week.
     *
     * @param array|null $dates An optional array containing 'startDate' and 'endDate'.
     */
    public function getDatatablesStudentByWeek($dates = null)
    {
        $startOfWeek = isset($dates['startDate']) ? $dates['startDate'] : Carbon::now()->startOfWeek()->format('Y-m-d');
        $endOfWeek = isset($dates['endDate']) ? $dates['endDate'] : Carbon::now()->endOfWeek()->format('Y-m-d');
        $currentUser = auth()->user();
        $userId = null;
        if ($currentUser->role->name_alias == 'mahasiswa') {
            $userId = $currentUser->id;
        }
        $groupedData = $this->getAttendances(null, $userId, null, $startOfWeek, $endOfWeek, 'mahasiswa')->groupBy('user_id');
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
                $status = $attendance ? $attendance->status : '-';

                $row["day_" . ($i + 1)] = $status;
                // Increment the count for each status
                if ($status !== '-') {
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
                    }
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
                }
            ]
        );
    }

    /**
     * Get the data formatted for DataTables for attendances by month.
     *
     * @param array|null $dates An optional array containing 'startDate' and 'endDate'.
     */
    public function getDatatablesStudentByMonth($dates = null)
    {
        $startOfMonth = isset($dates['startDate']) ? $dates['startDate'] : Carbon::now()->startOfMonth()->format('Y-m-d');
        $endOfMonth = isset($dates['endDate']) ? $dates['endDate'] : Carbon::now()->endOfMonth()->format('Y-m-d');
        $currentUser = auth()->user();
        $userId = null;
        if ($currentUser->role->name_alias == 'mahasiswa') {
            $userId = $currentUser->id;
        }
        $groupedData = $this->getAttendances(null, $userId, null, $startOfMonth, $endOfMonth, 'mahasiswa')->groupBy('user_id');

        if ($groupedData->isEmpty()) {
            return datatables()->of(collect())->make(true);
        }

        $formattedData = $groupedData->map(function ($attendances, $userId) use ($startOfMonth, $endOfMonth) {
            $user = $attendances->first()->user;
            $row = [
                'id' => $user->id,
                'student' => $user->name,
                'week_1' => '-',
                'week_2' => '-',
                'week_3' => '-',
                'week_4' => '-',
                'week_5' => '-',
                'total_present' => 0,
                'total_absent' => 0,
                'total_late' => 0,
                'total_sick' => 0,
                'total_leave' => 0,
            ];

            for ($i = 0; $i < 5; $i++) {
                $startOfWeek = Carbon::parse($startOfMonth)->addWeeks($i)->startOfWeek()->format('Y-m-d');
                $endOfWeek = Carbon::parse($startOfMonth)->addWeeks($i)->endOfWeek()->format('Y-m-d');

                $weeklyAttendances = $attendances->filter(function ($att) use ($startOfWeek, $endOfWeek) {
                    return Carbon::parse($att->attendance_date)->between($startOfWeek, $endOfWeek);
                });

                if ($weeklyAttendances->isNotEmpty()) {
                    $statuses = $weeklyAttendances->groupBy('status')->map->count();
                    $row["week_" . ($i + 1)] = $statuses->map(function ($count, $status) {
                        return "$status: $count";
                    })->implode(', ');

                    $row['total_present'] += $statuses->get('H', 0);
                    $row['total_absent'] += $statuses->get('A', 0);
                    $row['total_late'] += $statuses->get('T', 0);
                    $row['total_sick'] += $statuses->get('S', 0);
                    $row['total_leave'] += $statuses->get('I', 0);
                } else {
                    $row["week_" . ($i + 1)] = '-';
                }
            }

            return $row;
        })->values();

        return $this->formatDataTablesResponse(
            $formattedData,
            [
                'student' => function ($data) {
                    return $data['student'];
                },
                'id' => function ($data) {
                    return $data['id'];
                },
                'week_1' => function ($data) {
                    return $data['week_1'];
                },
                'week_2' => function ($data) {
                    return $data['week_2'];
                },
                'week_3' => function ($data) {
                    return $data['week_3'];
                },
                'week_4' => function ($data) {
                    return $data['week_4'];
                },
                'week_5' => function ($data) {
                    return $data['week_5'];
                },
                'total_present' => function ($data) {
                    return $data['total_present'];
                },
                'total_absent' => function ($data) {
                    return $data['total_absent'];
                },
                'total_late' => function ($data) {
                    return $data['total_late'];
                },
                'total_sick' => function ($data) {
                    return $data['total_sick'];
                },
                'total_leave' => function ($data) {
                    return $data['total_leave'];
                }
            ]
        );
    }

    /**
     * Get the data formatted for DataTables for lecture by date.
     */
    public function getDatatablesLectureByDate()
    {
        $today = Carbon::today()->toDateString();
        $currentUser = auth()->user();
        $userId = null;
        if ($currentUser->role->name_alias == 'dosen') {
            $userId = $currentUser->id;
        }
        $data = $this->getAttendances(null, $userId, $today, null, null, 'dosen');
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
                'lecture' => function ($data) {
                    return $data->user ? $data->user->name : '-';
                },
                'action' => function ($data) {
                    $encodedId = base64_encode($data->id);
                    return $this->getActionButtons(
                        $encodedId,
                        'showAttendance',
                        // 'confirmDeleteCourse',
                        null,
                        'backend.attendances.lecturers.date.edit',
                    );
                }
            ]
        );
    }

    /**
     * Get the data formatted for DataTables for attendances by week for lecture.
     */
    public function getDatatablesLectureByWeek()
    {
        $startOfWeek = Carbon::now()->startOfWeek()->format('Y-m-d');
        $endOfWeek = Carbon::now()->endOfWeek()->format('Y-m-d');
        $currentUser = auth()->user();
        $userId = null;
        if ($currentUser->role->name_alias == 'dosen') {
            $userId = $currentUser->id;
        }
        $groupedData = $this->getAttendances(null, $userId, null, $startOfWeek, $endOfWeek, 'dosen')->groupBy('user_id');
        if ($groupedData->isEmpty()) {
            return datatables()->of(collect())->make(true);
        }
        $daysInWeek = 7;
        $formattedData = $groupedData->map(function ($attendances, $userId) use ($daysInWeek, $startOfWeek) {
            $user = $attendances->first()->user;
            $row = [
                'lecture' => $user->name,
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
                $status = $attendance ? $attendance->status : '-';

                $row["day_" . ($i + 1)] = $status;
                // Increment the count for each status
                if ($status !== '-') {
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
                    }
                }
            }

            return $row;
        })->values();

        // Return format the data for DataTables
        return $this->formatDataTablesResponse(
            $formattedData,
            [
                'lecture' => function ($data) {
                    return $data['lecture'];
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
                }
            ]
        );
    }

    /**
     * Get the data formatted for DataTables for attendances by month for lecture.
     */
    public function getDatatablesLectureByMonth()
    {
        $startOfMonth = Carbon::now()->startOfMonth()->format('Y-m-d');
        $endOfMonth = Carbon::now()->endOfMonth()->format('Y-m-d');
        $currentUser = auth()->user();
        $userId = null;
        if ($currentUser->role->name_alias == 'dosen') {
            $userId = $currentUser->id;
        }
        $groupedData = $this->getAttendances(null, $userId, null, $startOfMonth, $endOfMonth, 'dosen')->groupBy('user_id');

        if ($groupedData->isEmpty()) {
            return datatables()->of(collect())->make(true);
        }

        $formattedData = $groupedData->map(function ($attendances, $userId) use ($startOfMonth, $endOfMonth) {
            $user = $attendances->first()->user;
            $row = [
                'id' => $user->id,
                'lecture' => $user->name,
                'week_1' => '-',
                'week_2' => '-',
                'week_3' => '-',
                'week_4' => '-',
                'week_5' => '-',
                'total_present' => 0,
                'total_absent' => 0,
                'total_late' => 0,
                'total_sick' => 0,
                'total_leave' => 0,
            ];

            for ($i = 0; $i < 5; $i++) {
                $startOfWeek = Carbon::parse($startOfMonth)->addWeeks($i)->startOfWeek()->format('Y-m-d');
                $endOfWeek = Carbon::parse($startOfMonth)->addWeeks($i)->endOfWeek()->format('Y-m-d');

                $weeklyAttendances = $attendances->filter(function ($att) use ($startOfWeek, $endOfWeek) {
                    return Carbon::parse($att->attendance_date)->between($startOfWeek, $endOfWeek);
                });

                if ($weeklyAttendances->isNotEmpty()) {
                    $statuses = $weeklyAttendances->groupBy('status')->map->count();
                    $row["week_" . ($i + 1)] = $statuses->map(function ($count, $status) {
                        return "$status: $count";
                    })->implode(', ');

                    $row['total_present'] += $statuses->get('H', 0);
                    $row['total_absent'] += $statuses->get('A', 0);
                    $row['total_late'] += $statuses->get('T', 0);
                    $row['total_sick'] += $statuses->get('S', 0);
                    $row['total_leave'] += $statuses->get('I', 0);
                } else {
                    $row["week_" . ($i + 1)] = '-';
                }
            }

            return $row;
        })->values();

        return $this->formatDataTablesResponse(
            $formattedData,
            [
                'lecture' => function ($data) {
                    return $data['lecture'];
                },
                'id' => function ($data) {
                    return $data['id'];
                },
                'week_1' => function ($data) {
                    return $data['week_1'];
                },
                'week_2' => function ($data) {
                    return $data['week_2'];
                },
                'week_3' => function ($data) {
                    return $data['week_3'];
                },
                'week_4' => function ($data) {
                    return $data['week_4'];
                },
                'week_5' => function ($data) {
                    return $data['week_5'];
                },
                'total_present' => function ($data) {
                    return $data['total_present'];
                },
                'total_absent' => function ($data) {
                    return $data['total_absent'];
                },
                'total_late' => function ($data) {
                    return $data['total_late'];
                },
                'total_sick' => function ($data) {
                    return $data['total_sick'];
                },
                'total_leave' => function ($data) {
                    return $data['total_leave'];
                }
            ]
        );
    }

    /**
     * Get the validation rules for the form request.
     * @param string|null $attendanceId The user ID.
     * @return array The validation rules.
     */
    public function getValidationRules(?string $attendanceId = null): array
    {
        return [
            'status' => ['required', new Enum(AttendanceStatus::class)],
            'remarks' => 'nullable',
        ];
    }

    /**
     * Get the validation error messages for the form fields.
     * @return array The validation error messages.
     */
    public function getValidationErrorMessages(): array
    {
        return [
            'status.required' => 'Status tidak boleh kosong!',
            'status.Enum' => 'Status harus merupakan salah satu dari: Hadir, Sakit, Izin, Terlambat dan Aplha!',
        ];
    }

    /**
     * Store or update a Attendance.
     *
     * @param array $data
     */
    public function storeOrUpdate($data)
    {
        // Create or update the attendance
        $attendance = $this->attendanceModel->updateOrCreate(
            ['id' => $data['id'] ?? null],
            [
                'status' => $data['status'],
                'remarks' => $data['remarks'],
            ]
        );
        return $attendance;
    }

}
