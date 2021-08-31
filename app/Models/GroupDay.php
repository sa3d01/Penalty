<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupDay extends Model
{
    use HasFactory;
    protected $fillable = [
        'group_id',
        'name',
        'start_time',
        'duration',
        'activity_id',
        'comment',
    ];

    protected $casts = [
        'start_time' => 'datetime',
    ];

    public function group():object
    {
        return $this->belongsTo(Group::class);
    }
    public function activity():object
    {
        return $this->belongsTo(Activity::class);
    }
}
