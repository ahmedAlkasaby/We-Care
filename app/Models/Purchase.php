<?php

namespace App\Models;



class Purchase extends MainModel
{
    protected $fillable=['total_price'];

    public function items()
    {
        return $this->belongsToMany(Item::class, 'purchase_item')->withPivot('amount', 'unit_price');
    }
}
