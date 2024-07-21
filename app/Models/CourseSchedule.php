<?php

namespace App\Models;

use App\Enums\DayOfWeek;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;

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
        return $value ? Carbon::parse($value)->format('H:i') : null;
    }

    // Mutator for check_in_start
    public function setCheckInStartAttribute($value)
    {
        $this->attributes['check_in_start'] = $this->parseTime($value);
    }

    // Accessor for check_in_end
    public function getCheckInEndAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('H:i') : null;
    }

    // Mutator for check_in_end
    public function setCheckInEndAttribute($value)
    {
        $this->attributes['check_in_end'] = $this->parseTime($value);
    }

    // Accessor for check_out_start
    public function getCheckOutStartAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('H:i') : null;
    }

    // Mutator for check_out_start
    public function setCheckOutStartAttribute($value)
    {
        $this->attributes['check_out_start'] = $this->parseTime($value);
    }

    // Accessor for check_out_end
    public function getCheckOutEndAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('H:i') : null;
    }

    // Mutator for check_out_end
    public function setCheckOutEndAttribute($value)
    {
        $this->attributes['check_out_end'] = $this->parseTime($value);
    }

    // Method to parse time
    private function parseTime($value)
    {
        try {
            return Carbon::createFromFormat('H:i', $value)->format('H:i:s');
        } catch (InvalidArgumentException $e) {
            throw new InvalidArgumentException("Error: Not enough data available to satisfy format. Ensure the time format is 'H:i'.");
        }
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
