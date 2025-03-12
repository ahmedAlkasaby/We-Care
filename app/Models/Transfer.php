<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transfer extends MainModel
{

    protected $fillable=[
        'donation_id',
        'case_id',
        'price',
        'type',
        'archive'
    ];

    public function items()
    {
        return $this->belongsToMany(Item::class, 'transfer_item')->withPivot('amount');
    }

    public function case() {
        return $this->belongsTo(CharityCase::class, 'case_id');
    }

    public function get_price(){
        if($this->type=='price'){
            return $this->price;
        }else{
            return $this->items->sum(function($item){
                return $item->price * $item->pivot->amount;
            });
        }
    }



    public function scopeFilter($query, $search = null)
    {

        if ($search) {
            $query->whereHas('case', function ($q) use ($search) {
                $q->whereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', '%'.$search.'%'); // Use 'like' for pattern matching
                });
            });
        }
    }
}
