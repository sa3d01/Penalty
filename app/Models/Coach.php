<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coach extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'sport_id',
        'academy_id',
        'city',
        'nationality',
        'nationality_id',
    ];

    public function user():object
    {
        return $this->belongsTo(User::class);
    }
    public function sport():object
    {
        return $this->belongsTo(Sport::class);
    }
    public function academy():object
    {
        return $this->belongsTo(Academy::class);
    }
    public function courses()
    {
        return $this->belongsToMany(Course::class, "course_coach", "coach_id", "course_id");
    }
    public function groups()
    {
        return $this->belongsToMany(Group::class, "group_coach", "coach_id", "group_id");
    }
}
