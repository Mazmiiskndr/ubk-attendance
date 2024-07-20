<?php

namespace App\Repositories\Kelas;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Kelas;

class KelasRepositoryImplement extends Eloquent implements KelasRepository
{
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
}
