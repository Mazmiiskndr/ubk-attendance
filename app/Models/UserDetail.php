<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserDetail extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'gender',
        'indent_number',
        'position',
        'phone_number',
        'birthdate',
        'address',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
