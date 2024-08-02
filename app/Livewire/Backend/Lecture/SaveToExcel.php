<?php

namespace App\Livewire\Backend\Lecture;

use App\Exports\LectureExport;
use App\Services\User\UserService;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class SaveToExcel extends Component
{
    public function render()
    {
        return view('livewire.backend.lecture.save-to-excel');
    }

    /**
     * Exports a report of lecture to a XlSX file.
     * @param \App\Services\User\UserService $userService Service to generate report data.
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse XlSX file download response.
     */
    public function saveToExcel(UserService $userService)
    {
        return Excel::download(new LectureExport($userService), 'data-dosen-' . date('Y-m-d') . '.xlsx');
    }
}
