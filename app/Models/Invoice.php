<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'cashier_id',
        'user_id',
        'model',
        'model_id',
        'month',
        'invoice_id',
        'amount',
    ];


    public function cashier():object
    {
        return $this->belongsTo(User::class,'cashier_id','id');
    }
    public function user():object
    {
        return $this->belongsTo(User::class);
    }
    public function course():object
    {
        return $this->belongsTo(Course::class,'model_id','id');
    }
    public function group():object
    {
        return $this->belongsTo(Group::class,'model_id','id');
    }
}
