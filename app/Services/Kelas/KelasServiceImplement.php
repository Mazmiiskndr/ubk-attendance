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

  /**
   * Get kelas by ID
   * @param int $kelasId
   * @return \Illuminate\Database\Eloquent\Model|mixed
   * @throws \InvalidArgumentException
   */
  public function getKelasById($kelasId)
  {
    return $this->handleRepositoryCall('getKelasById', [$kelasId]);
  }

  /**
   * Delete kelas by given IDs
   * @param array|int $courseIds
   * @return void
   * @throws \InvalidArgumentException
   */
  public function deleteKelas($courseIds)
  {
    return $this->handleRepositoryCall('deleteKelas', [$courseIds]);
  }

  /**
   * Get the validation rules for the form request.
   * @param string|null $kelasId The user ID.
   * @return array The validation rules.
   */
  public function getValidationRules(?string $kelasId = null)
  {
    return $this->handleRepositoryCall('getValidationRules', [$kelasId]);
  }

  /**
   * Get the validation error messages for the form fields.
   * @return array The validation error messages.
   */
  public function getValidationErrorMessages()
  {
    return $this->handleRepositoryCall('getValidationErrorMessages');
  }

  /**
   * Store or update a Kelas.
   * @param array $data
   */
  public function storeOrUpdateKelas($data)
  {
    return $this->handleRepositoryCall('storeOrUpdateKelas', [$data]);
  }
}
