<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class State extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'states';

    protected $fillable = [
        'user_id',
        'status',
        'controller_notes',
    ];

    /**
     * Get the user that owns the state.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
