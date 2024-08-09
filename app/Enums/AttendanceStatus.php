<?php

namespace App\Enums;

enum AttendanceStatus: string
{
    case Hadir = 'H';
    case Sakit = 'S';
    case Izin = 'I';
    case Terlambat = 'T';
    case Alpha = 'A';

    public function getDescription(): string
    {
        return match ($this) {
            self::Hadir => 'Hadir',
            self::Sakit => 'Sakit',
            self::Izin => 'Izin',
            self::Terlambat => 'Terlambat',
            self::Alpha => 'Alpha',
        };
    }
}
