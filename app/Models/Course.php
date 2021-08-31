<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'academy_id',
        'sport_id',
        'from_date',
        'to_date',
        'price',
        'days',
    ];

    protected $casts = [
        'days' => 'array',
        'from_date' => 'date',
        'to_date' => 'date',
    ];
    public function getFromDateAttribute(){
        return Carbon::parse($this->attributes['from_date'])->format('Y/m/d');
    }
    public function getToDateAttribute(){
        return Carbon::parse($this->attributes['to_date'])->format('Y/m/d');
    }
    public function sport():object
    {
        return $this->belongsTo(Sport::class);
    }
    public function academy():object
    {
        return $this->belongsTo(Academy::class);
    }

    public function course_days()
    {
        return $this->hasMany(CourseDay::class,'course_id','id');
    }

    public function players()
    {
        return $this->belongsToMany(Player::class, "course_player", "course_id", "player_id")->withTimestamps();
    }
    public function coaches()
    {
        return $this->belongsToMany(Coach::class, "course_coach", "course_id", "coach_id")->withTimestamps();
    }
}
