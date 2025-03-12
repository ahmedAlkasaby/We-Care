<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends MainModel
{

    protected $fillable=[
        'name',
        'phone',
        'message',
        'read',
        'email'
    ];

    public function scopeFilter($query, $search = null)
    {
        $query->when($search, function ($q, $search) {
            $q->where('name', 'like', '%' . $search . '%')
            ->orWhere('phone','like','%' . $search . '%')
            ->orWhere('message','like','%' . $search . '%');
        });
    }
}
