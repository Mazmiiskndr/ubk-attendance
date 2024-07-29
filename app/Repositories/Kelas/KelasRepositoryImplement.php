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
     * Get kelas by ID
     * @param int $kelasId
     * @return \Illuminate\Database\Eloquent\Model|mixed
     * @throws \InvalidArgumentException
     */
    public function getKelasById($kelasId)
    {
        $kelas = $this->kelasModel->find($kelasId);

        if (!$kelas) {
            throw new \InvalidArgumentException("Kelas ID {$kelasId} cannot be found.");
        }

        return $kelas;
    }

    /**
     * Delete kelas by given IDs
     * @param array|int $courseIds
     * @return void
     * @throws \InvalidArgumentException
     */
    public function deleteKelas($courseIds)
    {
        // Ensure $courseIds is an array
        $courseIds = is_array($courseIds) ? $courseIds : [$courseIds];

        // Fetch kelas by IDs
        $kelas = $this->kelasModel->whereIn('id', $courseIds)->get();

        if ($kelas->isEmpty()) {
            throw new \InvalidArgumentException("Kelas with the given IDs cannot be found.");
        }

        // Delete the kelas
        $this->kelasModel->whereIn('id', $courseIds)->delete();
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

    /**
     * Get the validation rules for the form request.
     * @param string|null $kelasId The user ID.
     * @return array The validation rules.
     */
    public function getValidationRules(?string $kelasId = null): array
    {
        return [
            'name' => 'required',
            'room' => 'required',
        ];
    }

    /**
     * Get the validation error messages for the form fields.
     * @return array The validation error messages.
     */
    public function getValidationErrorMessages(): array
    {
        return [
            'name.required' => 'Nama Kelas tidak boleh kosong!',
            'room.required' => 'Nama Kelas tidak boleh kosong!',
        ];
    }

    /**
     * Store or update a Kelas.
     *
     * @param array $data
     * @return Kelas
     */
    public function storeOrUpdateKelas($data)
    {
        // Create or update the kelas
        $kelas = $this->kelasModel->updateOrCreate(
            ['id' => $data['id'] ?? null],
            [
                'name' => $data['name'],
                'room' => $data['room'],
            ]
        );
        return $kelas;
    }
}
