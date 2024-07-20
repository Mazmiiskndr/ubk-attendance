<?php

namespace App\Repositories\Kelas;

use App\Traits\{DataTablesTrait, ActionsButtonTrait};
use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Kelas;

class KelasRepositoryImplement extends Eloquent implements KelasRepository
{
    use DataTablesTrait, ActionsButtonTrait;
    /**
     * Model class to be used in this repository for the common methods inside Eloquent
     * Don't remove or change $this->model variable name
     * @property Kelas|mixed $kelasModel;
     */
    protected $kelasModel;

    public function __construct(Kelas $kelasModel)
    {
        $this->kelasModel = $kelasModel;
    }

    /**
     * Get all kelas with limit
     * @param int|null $limit
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getKelas($limit = null)
    {
        $query = $this->kelasModel->latest();

        if ($limit !== null) {
            $query->limit($limit);
        }

        $kelas = $query->get();

        return $kelas;
    }

    /**
     * Get the data formatted for DataTables for course kelas.
     * @return \Illuminate\Http\JsonResponse
     */
    public function getKelasDatatables()
    {
        // Retrieve the groups data from the group model
        $data = $this->getKelas();

        if ($data->isEmpty()) {
            return datatables()->of(collect())->make(true);
        }
        // Return format the data for DataTables
        return $this->formatDataTablesResponse(
            $data,
            [
                'action' => function ($data) {
                    $encodedId = base64_encode($data->id);
                    return $this->getActionButtons(
                        $encodedId,
                        'showKelas',
                        'confirmDeleteKelas',
                    );

                }
            ]
        );
    }
}
