<?php

namespace App\Models;



class Payment extends MainModel
{
    protected $fillable=[
        'name','active'
    ];

    public function donations()
    {
        return $this->hasMany(Donation::class,'payment_id','payments');
    }
    public function scopeFilter($query, $search = null)
    {
        $query->when($search, function ($q, $search) {

            $q->where('name', 'like', '%' . $search . '%');

        });
    }
}
