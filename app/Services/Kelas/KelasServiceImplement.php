<?php

namespace App\Services\Kelas;

use App\Traits\HandleRepositoryCall;
use LaravelEasyRepository\Service;
use App\Repositories\Kelas\KelasRepository;

class KelasServiceImplement extends Service implements KelasService
{
  use HandleRepositoryCall;
  /**
   * don't change $this->mainRepository variable name
   * because used in extends service class
   */
  protected $mainRepository;

  public function __construct(KelasRepository $mainRepository)
  {
    $this->mainRepository = $mainRepository;
  }

  /**
   * Get all kelas with limit
   * @param int|null $limit
   * @return \Illuminate\Database\Eloquent\Collection|static[]
   */
  public function getKelas($limit = null)
  {
    return $this->handleRepositoryCall('getKelas', [$limit]);
  }

  /**
   * Get the data formatted for DataTables for course kelas.
   * @return \Illuminate\Http\JsonResponse
   */
  public function getKelasDatatables()
  {
    return $this->handleRepositoryCall('getKelasDatatables');
  }
}
