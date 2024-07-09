<?php

namespace App\Helpers;

class ActionButtonsBuilder
{
    private $editRoute;
    private $type = 'button';
    private $onclickEdit;
    private $onclickDelete;
    private $identity;

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
     * Build the HTML string for the edit button according to the given identity.
     * @return string
     */
    private function buildEditButton()
    {
        if (!$this->onclickEdit) {
            return '';
        }

        return $this->type == 'link'
            ? '<a href="' . route($this->editRoute, $this->identity)
            . '" class="edit btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>'
            : '&nbsp;<button type="button" class="edit btn btn-primary btn-sm"'
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

        return '&nbsp;<button type="button" class="delete btn btn-danger btn-sm"'
            . 'onclick="' . $this->onclickDelete . '(\'' . $this->identity . '\')">'
            . '<i class="fas fa-trash"></i></button>';
    }

    /**
     * Build the HTML string for the edit and delete buttons according to the given identity.
     * @return string
     */
    public function build()
    {
        return $this->buildEditButton() . $this->buildDeleteButton();
    }
}
