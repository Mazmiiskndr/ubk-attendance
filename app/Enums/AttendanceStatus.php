<?php

namespace App\Enums;

enum AttendanceStatus: string
{
    const Hadir = 'H';
    const Sakit = 'S';
    const Izin = 'I';
    const Terlambat = 'T';
    const Alpha = 'A';
}