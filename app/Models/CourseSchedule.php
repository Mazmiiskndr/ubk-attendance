<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseSchedule extends Model
{
    use HasFactory;

    protected $table = 'courses';
    protected $guarded = [];
    public $timestamps = false;

    protected $fillable = [
        'id',
        'course_id',
        'check_in_start',
        'check_in_end',
        'check_out_start',
        'check_out_end'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

}
