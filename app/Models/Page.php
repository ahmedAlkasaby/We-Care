<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends MainModel
{
    use SoftDeletes;

    protected $fillable=[
        'name',
        'description',
        'active'
    ];

    public function scopeFilter($query, $search = null,$trashed=false)
    {
        $query->when($search, function ($q, $search) {

            $q->where('name', 'like', '%' . $search . '%')->orWhere('description','like','%' . $search . '%');

        });
        $query->when($trashed,function($q){
            $q->onlyTrashed();
        });
    }
}
