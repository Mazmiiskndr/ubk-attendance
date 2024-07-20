<?php

namespace App\Livewire\Backend\Lecture;

use App\Services\User\UserService;
use Livewire\Attributes\On;
use Livewire\Component;

class Datatables extends Component
{
    public function render()
    {
        return view('livewire.backend.lecture.datatables');
    }

    public function getDataTable(UserService $userService)
    {
        return $userService->getLectureDatatables();
    }

    #[On('confirmLecture')]
    public function deleteLecture(UserService $userService, $lectureId)
    {
        try {
            $userService->deleteUsers(base64_decode($lectureId));

            $this->dispatch('show-toast', ['type' => 'success', 'message' => 'Dosen berhasil hapus!']);

            $this->refreshDataTable();
        } catch (\Throwable $th) {
            $this->dispatch('show-toast', ['type' => 'error', 'message' => 'Error : ' . $th->getMessage()]);
        }
    }

    #[On('deleteBatchLecturers')]
    public function deleteBatchLecturers(UserService $userService, $lectureIds)
    {
        try {
            $userService->deleteUsers($lectureIds);

            $this->dispatch('show-toast', ['type' => 'success', 'message' => 'Dosen berhasil hapus!']);

            $this->refreshDataTable();
        } catch (\Throwable $th) {
            $this->dispatch('show-toast', ['type' => 'error', 'message' => 'Error : ' . $th->getMessage()]);
        }
    }

    public function refreshDataTable()
    {
        $this->dispatch('refreshDatatable');
    }
}
