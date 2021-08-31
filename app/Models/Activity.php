<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'sport_id',
    ];

    public function sport():object
    {
        return $this->belongsTo(Sport::class);
    }
}
