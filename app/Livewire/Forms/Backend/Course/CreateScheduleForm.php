<?php

namespace App\Livewire\Forms\Backend\Course;

use Livewire\Attributes\Validate;
use Livewire\Form;

class CreateScheduleForm extends Form
{
    /**
     * The properties of a schedules object.
     */
    public $checkInStart, $checkInEnd, $day, $checkOutStart, $checkOutEnd;
}
