<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;
    protected $fillable = [
        'academy_id',
        'user_id',
        'birth_date',
        'nationality',
        'nationality_id',
        'ad_id',
    ];

    public function academy():object
    {
        return $this->belongsTo(Academy::class);
    }
    public function user():object
    {
        return $this->belongsTo(User::class);
    }
    public function ad():object
    {
        return $this->belongsTo(Ad::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, "course_player", "player_id", "course_id")->withTimestamps();
    }
    public function groups()
    {
        return $this->belongsToMany(Group::class, "group_player", "player_id", "group_id")->withTimestamps();
    }
}
