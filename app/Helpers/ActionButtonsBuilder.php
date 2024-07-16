<?php

namespace App\Helpers;

class ActionButtonsBuilder
{
    private $editRoute;
    private $type = 'button';
    private $typeDetail = 'link';
    private $onclickEdit;
    private $onclickDelete;
    private $identity;

    private $onclickDetail;

    private $detailRoute;

    /**
     * Set the unique identifier for the current data row.
     * @param mixed $identity
     * @return $this
     */
    public function setIdentity($identity)
    {
        $this->identity = $identity;
        return $this;
    }

    /**
     * Set the route name for the edit action.
     * @param string $editRoute
     * @return $this
     */
    public function setEditRoute($editRoute)
    {
        $this->editRoute = $editRoute;
        return $this;
    }

    /**
     * Set the route name for the detail action.
     * @param string $detailRoute
     * @return $this
     */
    public function setDetailRoute($detailRoute)
    {
        $this->detailRoute = $detailRoute;
        return $this;
    }

    /**
     * Set the type of the action button (e.g. link or button).
     * @param string $type
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Set the type of the action button (e.g. link or button).
     * @param string $type
     * @return $this
     */
    public function setTypeDetail($typeDetail)
    {
        $this->typeDetail = $typeDetail;
        return $this;
    }

    /**
     * Set the JavaScript function to be called when the edit button is clicked.
     * @param string $onclickEdit
     * @return $this
     */
    public function setOnclickEdit($onclickEdit)
    {
        $this->onclickEdit = $onclickEdit;
        return $this;
    }

    /**
     * Set the JavaScript function to be called when the delete button is clicked.
     * @param string $onclickDelete
     * @return $this
     */
    public function setOnclickDelete($onclickDelete)
    {
        $this->onclickDelete = $onclickDelete;
        return $this;
    }

    /**
     * Set the JavaScript function to be called when the detail button is clicked.
     * @param string $onclickDetail
     * @return $this
     */
    public function setOnclickDetail($onclickDetail)
    {
        $this->onclickDetail = $onclickDetail;
        return $this;
    }

    /**
     * Build the HTML string for the edit button according to the given identity.
     * @return string
     */
    private function buildEditButton()
    {
        if (!$this->onclickEdit) {
            return '';
        }

        return $this->type == 'link'
            ? '&nbsp;&nbsp;<a href="' . route($this->editRoute, $this->identity)
            . '" class="edit btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>'
            : '&nbsp;&nbsp;<button type="button" class="edit btn btn-primary btn-sm"'
            . 'onclick="' . $this->onclickEdit . '(\'' . $this->identity . '\')"><i class="fas fa-edit"></i></button>';
    }

    /**
     * Build the HTML string for the delete button according to the given identity.
     * @return string
     */
    private function buildDeleteButton()
    {
        if (!$this->onclickDelete) {
            return '';
        }

        return '&nbsp;&nbsp;<button type="button" class="delete btn btn-danger btn-sm"'
            . 'onclick="' . $this->onclickDelete . '(\'' . $this->identity . '\')">'
            . '<i class="fas fa-trash"></i></button>';
    }

    /**
     * Build the HTML string for the detail button according to the given identity.
     * @return string
     */
    private function buildDetailButton()
    {
        if (!$this->onclickDetail && !$this->detailRoute) {
            return '';
        }

        return $this->typeDetail == 'link'
            ? '<a href="' . route($this->detailRoute, $this->identity)
            . '" class="detail btn btn-info btn-sm"><i class="fas fa-eye"></i></a>'
            : '&nbsp;&nbsp;<button type="button" class="detail btn btn-info btn-sm"'
            . 'onclick="' . $this->onclickDetail . '(\'' . $this->identity . '\')">'
            . '<i class="fas fa-eye"></i></button>';
    }

    /**
     * Build the HTML string for the edit, detail and delete buttons according to the given identity.
     * @return string
     */
    public function build()
    {
        return $this->buildDetailButton() . $this->buildEditButton() . $this->buildDeleteButton();
    }
}
