<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends MainModel
{
    use SoftDeletes;

    protected $fillable=['image'];

    public function imageable()
    {
        return $this->morphTo();
    }
}
