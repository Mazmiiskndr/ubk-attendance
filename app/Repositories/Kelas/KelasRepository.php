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
}
