<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attendance extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'course_schedule_id',
        'check_in',
        'check_out',
        'attendance_date',
        'image_in',
        'image_out',
        'status',
        'remarks'
    ];

    protected $casts = [
        'attendance_date' => 'date',
    ];



    /**
     * Define the relationship with the User model
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function courseSchedule(): BelongsTo
    {
        return $this->belongsTo(CourseSchedule::class);
    }
}
