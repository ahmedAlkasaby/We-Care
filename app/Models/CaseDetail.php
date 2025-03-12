<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaseDetail extends MainModel
{
    protected $fillable = [
        'case_id',
        'code_name',
        'national_number',
        'condition',
        'type_of_aid',
        'number_of_peaple',
        'government',
        'city',
        'area',
        'street',
        'district',
        'building',
        'floor',
        'apartment',
    ];

    public function case()
    {
        return $this->belongsTo(CharityCase::class, 'case_id', 'id');
    }
}
