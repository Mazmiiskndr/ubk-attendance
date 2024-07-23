<?php

namespace App\Enums;

enum AttendanceStatus: string
{
    case Hadir = 'H';
    case Sakit = 'S';
    case Izin = 'I';
    case Terlambat = 'T';
    case Alpha = 'A';
}