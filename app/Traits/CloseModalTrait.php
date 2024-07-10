<?php

namespace App\Traits;

trait CloseModalTrait
{
    /**
     * Close the modal.
     */
    public function closeModal()
    {
        $this->dispatch('hide-modal');
        // Reset the form for the next client
        $this->resetFields();
        // Reset the validation error messages
        $this->resetErrorBag();
        // Reset the validation status
        $this->resetValidation();
    }
}
