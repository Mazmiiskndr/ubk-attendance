<?php

namespace App\Livewire\Backend\Student;

use App\Services\User\UserService;
use Livewire\Attributes\On;
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

    #[On('confirmStudent')]
    public function deleteStudent(UserService $userService, $studentId)
    {
        try {
            $userService->deleteUsers($studentId);

            $this->dispatch('show-toast', ['type' => 'success', 'message' => 'Mahasiswa berhasil hapus!']);

            $this->refreshDataTable();
        } catch (\Throwable $th) {
            $this->dispatch('show-toast', ['type' => 'error', 'message' => 'Error : ' . $th->getMessage()]);
        }
    }

    public function refreshDataTable()
    {
        $this->dispatch('refreshDatatable');
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
