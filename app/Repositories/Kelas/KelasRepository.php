<?php

namespace App\Repositories\Kelas;

use LaravelEasyRepository\Repository;

interface KelasRepository extends Repository
{
    /**
     * Get all kelas with limit
     * @param int|null $limit
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getKelas($limit);

    /**
     * Get the data formatted for DataTables for course kelas.
     * @return \Illuminate\Http\JsonResponse
     */
    public function getKelasDatatables();
}
