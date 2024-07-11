<?php

namespace App\Livewire\Backend\Student;

use App\Services\User\UserService;
use Livewire\Component;

class Datatables extends Component
{
    public function render()
    {
        return view('livewire.backend.student.datatables');
    }

    public function getDataTable(UserService $userService)
    {
        return $userService->getStudentDatatables();
    }

    // #[On('requestStudentById')]
    // public function getStudent($StudentId)
    // {
    //     $this->dispatch('deliverStudentToEditComponent', $StudentId);
    // }

    // /**
    //  * Refresh the DataTable when an  updated.
    //  */
    // #[On('StudentUpdated')]
    // public function refreshDataTable()
    // {
    //     $this->dispatch('refreshDatatable');
    // }
}
