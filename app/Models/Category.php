<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends MainModel
{

    protected $fillable=['active','name','description'];


    public function parent()
    {
        return $this->belongsTo(Category::class,'parent_category');
    }

    public function children()
    {
        return $this->hasMany(Category::class,'parent_category');
    }

    public function scopeFilter($query, $search = null)
    {
        $query->when($search, function ($q, $search) {

            $q->where('name', 'like', '%' . $search . '%');

        });
    }
    public function items(){
        return $this->hasMany(Item::class,"category_id","id");
    }
}
