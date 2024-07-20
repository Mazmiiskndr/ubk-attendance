<?php

namespace App\Services\Kelas;

use LaravelEasyRepository\BaseService;

interface KelasService extends BaseService
{
    /**
     * Get all kelas with limit
     * @param int|null $limit
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getKelas($limit = null);

    /**
     * Get the data formatted for DataTables for course kelas.
     * @return \Illuminate\Http\JsonResponse
     */
    public function getKelasDatatables();
}
