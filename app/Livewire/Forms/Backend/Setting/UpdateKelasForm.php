<?php

namespace App\Livewire\Forms\Backend\Setting;

use App\Services\Kelas\KelasService;
use Livewire\Attributes\Validate;
use Livewire\Form;

class UpdateKelasForm extends Form
{
    /**
     * The properties of a kelas object.
     */
    public $name, $room, $kelasId;

    public function setKelas($kelas)
    {
        $this->kelasId = $kelas->id;
        $this->name = $kelas->name;
        $this->room = $kelas->room;
    }

    /**
     * Get the validation rules for the model.
     * @return array
     */
    public function rules()
    {
        $kelasService = app(KelasService::class);
        return $kelasService->getValidationRules();
    }

    /**
     * Get the validation error messages from the kelas service.
     * @return array
     */
    public function messages()
    {
        $kelasService = app(KelasService::class);
        return $kelasService->getValidationErrorMessages();
    }

    /**
     * Store Or Update a new kelas.
     * @param KelasService $kelasService Kelas service instance
     */
    public function storeOrUpdate(KelasService $kelasService)
    {
        // Validate form fields
        $validated = $this->validate();
        $validated['id'] = $this->kelasId;
        // Attempt to create the new kelas
        $kelas = $kelasService->storeOrUpdateKelas($validated);
        // Reset the form for the next kelas
        $this->reset();
        return $kelas;
    }
}
