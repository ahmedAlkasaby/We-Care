<?php

namespace App\Models;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

class Donation extends MainModel
{
    protected $fillable=[
        'doner_id',
        'case_id',
        'payment_id',
        'price',
        'doner_price',
        'type',
        'confirm',
        'image'

    ];

    public function get_price(){
        if($this->type=='price'){
            return $this->price;
        }else{
            return $this->items->sum(function($item){
                return $item->price * $item->pivot->amount;
            });
        }
    }

    public function get_doner_price(){
        if($this->type=='price'){
            return $this->doner_price;
        }else{
            return $this->items->sum(function($item){
                return $item->doner_price * $item->pivot->amount;
            });
        }
    }

    public function doner()
    {
        return $this->belongsTo(User::class,'doner_id','id');
    }

    public function case()
    {
        return $this->belongsTo(CharityCase::class,'case_id','id');
    }

    public function items()
    {
        return $this->belongsToMany(Item::class, 'donation_item')->withPivot('amount', 'doner_amount');
    }



    public function scopeFilter($query,$doner_id=null,$price=null,$price_doner=null,$has_items=null,$case_id=null,$this_year=null,$this_month=null)
    {


        $query->when($doner_id, function ($q, $doner_id) {
            $q->where('doner_id', $doner_id );
        });

        $query->when($price, function ($q, $price) {
            $q->where('price','>=' ,$price );
        });
        $query->when($price_doner, function ($q, $price_doner) {
            $q->where('doner_price','>=' ,$price_doner );
        });

        $query->when(!is_null($has_items), function ($q) use ($has_items) {
            if ($has_items=='items') {
                // للحصول على التبرعات التي تحتوي على عناصر
                $q->has('items');
            } elseif($has_items=='price') {
                // للحصول على التبرعات التي لا تحتوي على عناصر
                $q->doesntHave('items');
            }
        });

        $query->when($case_id, function ($q, $case_id) {
            $q->where('case_id' ,$case_id );
        });

        $query->when($this_year, function ($q) {
            $currentMonth = Carbon::now()->month;
            $currentYear = Carbon::now()->year;
            $q->whereYear('created_at',$currentYear);
        });
        $query->when($this_month, function ($q) {
            $currentMonth = Carbon::now()->month;
            $currentYear = Carbon::now()->year;
            $q->whereMonth('created_at',$currentMonth)->whereYear('created_at',$currentYear);
        });
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }



}
