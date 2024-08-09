<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\Attendance\AttendanceService;
use App\Services\State\StateService;
use App\Services\User\UserService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public $attendanceService;
    public $stateService;
    public $userService;

    public function __construct(AttendanceService $attendanceService, StateService $stateService, UserService $userService)
    {
        $this->attendanceService = $attendanceService;
        $this->stateService = $stateService;
        $this->userService = $userService;
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
     */
    public function store(Request $request)
    {
        $message = '';

        if ($request->has('id') && $request->hasFile('img') && $request->file('img')->isValid()) {
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

        return $message;
    }

    /**
     * Handle enrollment requests for the controller.
     */
    public function enrollController(Request $request)
    {
        $key = $request->input('key');
        // Call checkStateStatus method from StateService
        $response = $this->stateService->checkStateStatus($key);
        // Return the response as JSON
        return $response;
    }

    /**
     * Handle enrollment requests for the controller.
     */
    public function regisController(Request $request)
    {
        $data['id'] = $request->input('id');
        $data['parameter'] = $request->input('parameter');

        if ($data['id'] == "kontroler" && $data['parameter'] != "") {
            $this->userService->storeOrUpdateState($data);
            return $data['parameter'];
        }

        // Jika tidak memenuhi syarat, kembalikan pesan kesalahan atau respon lain
        return 'Invalid request';
    }
}
