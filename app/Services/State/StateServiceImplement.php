<?php

namespace App\Services\State;

use LaravelEasyRepository\Service;
use App\Repositories\State\StateRepository;
use App\Traits\HandleRepositoryCall;

class StateServiceImplement extends Service implements StateService
{
  use HandleRepositoryCall;
  /**
   * don't change $this->mainRepository variable name
   * because used in extends service class
   */
  protected $mainRepository;

  public function __construct(StateRepository $mainRepository)
  {
    $this->mainRepository = $mainRepository;
  }

  /**
   * Check the state with status '1' and return its details.
   *
   * @param string $key
   * @return string JSON encoded array
   */
  public function checkStateStatus(string $key)
  {
    return $this->handleRepositoryCall('checkStateStatus', [$key]);
  }
}
