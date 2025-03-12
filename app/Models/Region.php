<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Region extends MainModel
{
    protected $fillable=['name','city_id','active'];


    public function city()
    {
        return $this->belongsTo(City::class,'city_id','id');
    }

    public function scopeFilter($query, $search = null)
    {
        $query->when($search, function ($q, $search) {

            $q->where('name', 'like', '%' . $search . '%');

        });
    }

    public function users()
    {
        return $this->hasMany(User::class,'region_id','id');
    }




}
