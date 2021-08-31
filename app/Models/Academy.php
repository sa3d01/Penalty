<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Academy extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ad_id',
        'country_id',
        'city',
        'district',
        'location',
        'academy_size_id',
    ];
    protected $casts = [
        'location' => 'json',
    ];
    public function user():object
    {
        return $this->belongsTo(User::class);
    }
    public function ad():object
    {
        return $this->belongsTo(Ad::class);
    }
    public function country():object
    {
        return $this->belongsTo(Country::class);
    }
    public function academy_size():object
    {
        return $this->belongsTo(AcademySize::class);
    }
    public function players()
    {
        return $this->hasMany(Player::class);
    }
    public function courses()
    {
        return $this->hasMany(Course::class);
    }
    public function groups()
    {
        return $this->hasMany(Group::class);
    }
}
