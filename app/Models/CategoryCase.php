<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryCase extends MainModel
{

    protected $fillable=[
        'name','description','active'
    ];
    public function scopeFilter($query, $search = null)
    {
        $query->when($search, function ($q, $search) {

            $q->where('name', 'like', '%' . $search . '%');

        });
    }

    public function cases()
    {
        return $this->hasMany(CharityCase::class,'category_case_id','id');
    }
}
