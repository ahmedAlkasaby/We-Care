<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends MainModel
{
    protected $fillable=['name','active'];
    

    public function regions()
    {
        return $this->hasMany(Region::class,'city_id','id');
    }

    public function scopeFilter($query, $search = null)
   {
        $query->when($search, function ($q, $search) {

            $q->where('name', 'like', '%' . $search . '%');

        });
    }

    public function users()
    {
        return $this->hasMany(User::class,'city_id','id');
    }


}
