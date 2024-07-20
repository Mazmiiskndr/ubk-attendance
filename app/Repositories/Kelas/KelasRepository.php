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

    /**
     * Get kelas by ID
     * @param int $kelasId
     * @return \Illuminate\Database\Eloquent\Model|mixed
     * @throws \InvalidArgumentException
     */
    public function getKelasById($kelasId);

    /**
     * Delete kelas by given IDs
     * @param array|int $courseIds
     * @return void
     * @throws \InvalidArgumentException
     */
    public function deleteKelas($courseIds);

    /**
     * Get the validation rules for the form request.
     * @param string|null $kelasId The user ID.
     * @return array The validation rules.
     */
    public function getValidationRules(?string $kelasId);

    /**
     * Get the validation error messages for the form fields.
     * @return array The validation error messages.
     */
    public function getValidationErrorMessages();

    /**
     * Store or update a Kelas.
     *
     * @param array $data
     */
    public function storeOrUpdateKelas($data);
}
