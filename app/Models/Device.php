<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $fillable=[
        'user_id',
        'token',
        'device_type',
        'imei'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
