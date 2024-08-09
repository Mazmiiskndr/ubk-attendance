<?php

namespace App\Enums;

use Carbon\Carbon;

enum DayOfWeek: string
{
    case Monday = 'Senin';
    case Tuesday = 'Selasa';
    case Wednesday = 'Rabu';
    case Thursday = 'Kamis';
    case Friday = "Jumat";
    case Saturday = 'Sabtu';
    case Sunday = 'Minggu';

    public static function getDescription($date): ?string
    {
        $dayOfWeekIso = Carbon::parse($date)->dayOfWeekIso;

        return match ($dayOfWeekIso) {
            1 => self::Monday->value,
            2 => self::Tuesday->value,
            3 => self::Wednesday->value,
            4 => self::Thursday->value,
            5 => self::Friday->value,
            6 => self::Saturday->value,
            7 => self::Sunday->value,
            default => null,
        };
    }
}
