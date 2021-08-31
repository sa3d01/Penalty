<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseDay extends Model
{
    use HasFactory;
    protected $fillable = [
        'course_id',
        'date',
        'start_time',
        'duration',
        'activity_id',
        'comment',
    ];

    protected $casts = [
        'date' => 'date',
        'start_time' => 'datetime',
    ];

    public function course():object
    {
        return $this->belongsTo(Course::class);
    }
    public function activity():object
    {
        return $this->belongsTo(Activity::class);
    }

    public function coaches()
    {
        return $this->belongsToMany(Coach::class, "course_coach_day", "coach_id", "course_day_id");
    }
}
