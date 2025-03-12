<?php

namespace App\Models;



class Item extends MainModel
{
    protected $fillable=['name','description','category_id','price','active','amount'];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function cases()
    {
        return $this->belongsToMany(CharityCase::class, 'charity_case_item')->withPivot('amount', 'amount_raised');

    }
    public function scopeFilter($query, $search = null,$category_id = null)
    {
        $query->when($search, function ($q, $search) {

            $q->where('name', 'like', '%' . $search . '%');

        });

        $query->when($category_id, function ($q, $category_id) {
            $q->where('category_id', $category_id);
        });
    }



    public function transfers()
    {
        return $this->belongsToMany(Transfer::class, 'transfer_item')->withPivot('amount');
    }

    public function donations()
    {
        return $this->belongsToMany(Donation::class, 'donation_item')->withPivot('amount', 'doner_amount');
    }

    public function purchases()
    {
        return $this->belongsToMany(Purchase::class, 'purchase_item')->withPivot('amount', 'unit_price');
    }

}
