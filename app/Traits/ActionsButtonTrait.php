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
     * @param $onclickDetail
     * @param $detailRoute
     * @param $detailType
     * @return string HTML string for the action buttons
     */
    private function getActionButtons(
        $id,
        $onclickEdit = null,
        $onclickDelete = null,
        $editRoute = null,
        $editType = 'button',
        $onclickDetail = null,
        $detailRoute = null,
        $detailType = 'button'
    ) {
        $actionButtonsBuilder = (new ActionButtonsBuilder())
            ->setType($editType)
            ->setTypeDetail($detailType)
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

        if ($onclickDetail) {
            $actionButtonsBuilder->setOnclickDetail($onclickDetail);
        }

        if ($detailRoute) {
            $actionButtonsBuilder->setDetailRoute($detailRoute);
        }

        return $actionButtonsBuilder->build();
    }
}
