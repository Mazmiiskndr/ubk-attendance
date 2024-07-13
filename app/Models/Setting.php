<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $table = 'settings';
    protected $guarded = [];
    public $timestamps = false;

    protected $fillable = [
        'id',
        'time_zone',
        'bot_token',
        'ip_address'
    ];

}
