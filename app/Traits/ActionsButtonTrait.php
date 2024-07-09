<?php

namespace App\Traits;

use App\Helpers\ActionButtonsBuilder;

trait ActionsButtonTrait
{
    /**
     * Generate action buttons for the DataTables row.
     * @param $id
     * @param $onclickEdit
     * @param $onclickDelete
     * @param $editRoute
     * @param $editType
     * @return string HTML string for the action buttons
     */
    private function getActionButtons($id, $onclickEdit = null, $onclickDelete = null, $editRoute = null, $editType = 'button')
    {
        $actionButtonsBuilder = (new ActionButtonsBuilder())
            ->setType($editType)
            ->setIdentity($id);

        if ($onclickEdit) {
            $actionButtonsBuilder->setOnclickEdit($onclickEdit);
        }

        if ($editRoute) {
            $actionButtonsBuilder->setEditRoute($editRoute);
        }

        if ($onclickDelete) {
            $actionButtonsBuilder->setOnclickDelete($onclickDelete);
        }

        return $actionButtonsBuilder->build();
    }
}
