<?php

namespace App\Livewire\Backend\Attendance\Student;

use App\Exports\DateStudentAttendanceExport;
use App\Services\Attendance\AttendanceService;
use Livewire\Attributes\On;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class DateSaveToExcel extends Component
{
    public $searchByDate = null;

    public function render()
    {
        return view('livewire.backend.attendance.student.date-save-to-excel');
    }

    #[On('searchByDate')]
    public function onclickSearchByDate($date)
    {
        $this->searchByDate = $date['searchByDate'];
    }

    /**
     * Exports a report of attendance student by date to a XlSX file.
     * @param AttendanceService $attendanceService Service to generate report data.
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse XlSX file download response.
     */
    public function saveToExcel(AttendanceService $attendanceService)
    {
        return Excel::download(new DateStudentAttendanceExport($attendanceService, $this->searchByDate), 'data-presensi-mahasiswa-' . ($this->searchByDate ?? date('Y-m-d')) . '.xlsx');
    }
}
