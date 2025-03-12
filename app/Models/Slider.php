<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Slider extends MainModel
{
    use SoftDeletes;
    protected $fillable=[
        'image',
        'case_id',
        'name',
        'description',
        'active'
    ];


    public function case()
    {
        return $this->belongsTo(CharityCase::class,'case_id','id');
    }
    public function scopeFilter($query, $search = null,$trashed=false)
    {
        $query->when($search, function ($q, $search) {

            $q->where('name', 'like', '%' . $search . '%');

        });
        $query->when($trashed,function($q){
            $q->onlyTrashed();
        });
    }
}
