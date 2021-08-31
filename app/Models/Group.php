<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'academy_id',
        'sport_id',
        'price',
        'days',
    ];

    protected $casts = [
        'days' => 'array',
    ];

    public function sport():object
    {
        return $this->belongsTo(Sport::class);
    }
    public function academy():object
    {
        return $this->belongsTo(Academy::class);
    }
    public function group_days()
    {
        return $this->hasMany(GroupDay::class,'group_id','id');
    }
    public function players()
    {
        return $this->belongsToMany(Player::class, "group_player", "group_id", "player_id")->withTimestamps();
    }
    public function coaches()
    {
        return $this->belongsToMany(Coach::class, "group_coach", "group_id", "coach_id")->withTimestamps();
    }
}
