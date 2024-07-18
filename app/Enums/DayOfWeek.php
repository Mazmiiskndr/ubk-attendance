<?php

namespace App\Enums;

enum DayOfWeek: string
{
    case Monday = 'Senin';
    case Tuesday = 'Selasa';
    case Wednesday = 'Rabu';
    case Thursday = 'Kamis';
    case Friday = "Jumat";
    case Saturday = 'Sabtu';
    case Sunday = 'Minggu';
}
