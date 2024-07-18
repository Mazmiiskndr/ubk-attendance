<?php

namespace App\Models;

use App\Enums\DayOfWeek;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseSchedule extends Model
{
    use HasFactory;

    protected $table = 'course_schedules';
    protected $guarded = [];
    protected $fillable = [
        'id',
        'course_id',
        'day',
        'check_in_start',
        'check_in_end',
        'check_out_start',
        'check_out_end'
    ];

    protected $casts = [
        'day' => DayOfWeek::class,
    ];

    // Accessor for check_in_start
    public function getCheckInStartAttribute($value)
    {
        return Carbon::createFromFormat('H:i:s', $value)->format('H : i');
    }

    // Accessor for check_in_end
    public function getCheckInEndAttribute($value)
    {
        return Carbon::createFromFormat('H:i:s', $value)->format('H : i');
    }

    // Accessor for check_out_start
    public function getCheckOutStartAttribute($value)
    {
        return Carbon::createFromFormat('H:i:s', $value)->format('H : i');
    }

    // Accessor for check_out_end
    public function getCheckOutEndAttribute($value)
    {
        return Carbon::createFromFormat('H:i:s', $value)->format('H : i');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

}
