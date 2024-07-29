<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $table = 'courses';
    protected $guarded = [];
    protected $fillable = [
        'id',
        'name',
        'lecturer_id',
        'class_id'
    ];

    public function lecturer()
    {
        return $this->belongsTo(User::class, 'lecturer_id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'class_id');
    }

    public function schedules()
    {
        return $this->hasMany(CourseSchedule::class, 'course_id');
    }
}
