<?php

namespace App\Livewire\Backend\Student;

use App\Exports\StudentExport;
use App\Services\User\UserService;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class SaveToExcel extends Component
{
    public function render()
    {
        return view('livewire.backend.student.save-to-excel');
    }

    /**
     * Exports a report of online users to a XlSX file.
     * @param \App\Services\User\UserService $userService Service to generate report data.
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse XlSX file download response.
     */
    public function saveToExcel(UserService $userService)
    {
        return Excel::download(new StudentExport($userService), 'data-mahasiswa-' . date('Y-m-d') . '.xlsx');
    }
}
