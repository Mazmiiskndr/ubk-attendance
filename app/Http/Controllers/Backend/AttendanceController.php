<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\Attendance\AttendanceService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public $attendanceService;

    public function __construct(AttendanceService $attendanceService)
    {
        $this->attendanceService = $attendanceService;
    }

    // START STUDENT
    public function showStudentAttendanceByDate()
    {
        return view('pages.backend.attendances.students.date');
    }

    public function showStudentAttendanceByDateDetail($encodedId)
    {
        try {
            $id = base64_decode($encodedId);
            if (!$id) {
                throw new \InvalidArgumentException("Invalid ID provided.");
            }

            $attendance = $this->attendanceService->getAttendanceById($id);
            return view('pages.backend.attendances.students.date-detail', compact('attendance'));
        } catch (\InvalidArgumentException $e) {
            // Handle the exception, for example by redirecting back with an error message
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function showStudentAttendanceByWeek()
    {
        return view('pages.backend.attendances.students.week');
    }

    public function showLectureAttendanceByDateDetail($encodedId)
    {
        try {
            $id = base64_decode($encodedId);
            if (!$id) {
                throw new \InvalidArgumentException("Invalid ID provided.");
            }

            $attendance = $this->attendanceService->getAttendanceById($id);
            return view('pages.backend.attendances.lecturers.date-detail', compact('attendance'));
        } catch (\InvalidArgumentException $e) {
            // Handle the exception, for example by redirecting back with an error message
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function showStudentAttendanceByMonth()
    {
        return view('pages.backend.attendances.students.month');
    }
    // END STUDENT

    // START LECTURE
    public function showLectureAttendanceByDate()
    {
        return view('pages.backend.attendances.lecturers.date');
    }

    public function showLectureAttendanceByWeek()
    {
        return view('pages.backend.attendances.lecturers.week');
    }
    public function showLectureAttendanceByMonth()
    {
        return view('pages.backend.attendances.lecturers.month');
    }
    // END LECTURE

    /**
     * Store the attendance data.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $message = '';

        if ($request->has('id') && $request->file('img')->isValid()) {
            $userId = $request->input('id');
            $file = $request->file('img');
            $filename = str()->uuid() . ".jpg";

            $hari_ini = now()->format('Y-m-d');
            // TODO: Day is not used in the code, consider removing it
            $day = $this->attendanceService->getDay($hari_ini);

            if ($this->attendanceService->isValidUserId($userId)) {
                $time = Carbon::now()->format('H:i:s');
                $status = $this->attendanceService->determineStatus($userId, $hari_ini, $time);
                $simpan_absen = $this->attendanceService->storeAttendanceData($userId, $hari_ini, $time, $status, $filename);
                $file->storeAs('public/assets/images/attendances', $filename);
                $message = $simpan_absen;
            } else {
                $message = "ID Tidak Ada";
            }
        } else {
            $message = "Coba Lagi";
        }

        return response()->json(['message' => $message]);
    }
}
