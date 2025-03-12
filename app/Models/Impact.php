<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Impact extends MainModel
{
    use SoftDeletes;

    protected $fillable=[
        'video',
        'case_id',
        'name',
        'description',
        'active'
    ];

    public function case()
    {
        return $this->belongsTo(CharityCase::class,'case_id','id');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
    public function scopeFilter($query, $search = null,$trashed=null)
    {
        $query->when($search, function ($q, $search) {

            $q->where('name', 'like', '%' . $search . '%');

        });
        $query->when($trashed,function($q){
            $q->onlyTrashed();
        });
    }

    public function scopeApiFilter($query, $filters)
    {
        $query->where('active', 1)
              ;

        $query->where(function ($q) use ($filters) {
            // Date range filter
            $q->when(isset($filters['start_date']) && isset($filters['end_date']), function ($q) use ($filters) {
                $q->whereHas('case', function($q) use ($filters) {
                    $q->whereBetween('date_end', [$filters['start_date'], $filters['end_date']]);
                });
            });

            // Search filter
            $q->when(isset($filters['search']), function ($q) use ($filters) {
                $q->where(function($q) use ($filters) {
                    $q->where('name', 'like', '%'.$filters['search'].'%')
                      ->orWhere('description', 'like', '%'.$filters['search'].'%')
                      ->orWhereHas('case', function($q) use ($filters) {
                          $q->where('name', 'like', '%'.$filters['search'].'%')
                            ->orWhere('description', 'like', '%'.$filters['search'].'%');
                      });
                });
            });

            // City filter
            $q->when(isset($filters['city_id']), function ($q) use ($filters) {
                $q->whereHas('case.user', function ($q) use ($filters) {
                    $q->where('city_id', $filters['city_id']);
                });
            });

            // Region filter
            $q->when(isset($filters['region_id']), function ($q) use ($filters) {
                $q->whereHas('case.user', function ($q) use ($filters) {
                    $q->where('region_id', $filters['region_id']);
                });
            });

            // Price need filter
            $q->when(isset($filters['price_need']), function ($q) use ($filters) {
                $q->whereHas('case', function($q) use ($filters) {
                    if ($q->type == 'price') {
                        $q->whereRaw('price - price_raised >= ?', [$filters['price_need']]);
                    } else {
                        $q->whereHas('items', function($q) use ($filters) {
                            $q->whereRaw('(items.price * (amount - amount_raised)) >= ?', [$filters['price_need']]);
                        });
                    }
                });
            });

            // Category filter
            $q->when(isset($filters['category_id']), function ($q) use ($filters) {
                $q->whereHas('case', function($q) use ($filters) {
                    $q->where('category_case_id', $filters['category_id']);
                });
            });

            // Urgent filter
            $q->when(isset($filters['is_urgent']) && $filters['is_urgent'] === 1, function ($q) {
                $q->whereHas('case', function($q) {
                    $q->where('priority', 'high');
                });
            });

            // Ending soon filter
            $q->when(isset($filters['is_ending']) && $filters['is_ending'] === 1, function ($q) {
                $q->whereHas('case', function($q) {
                    $q->whereBetween('date_end', [Carbon::now(), Carbon::now()->addWeek()]);
                });
            });

            // Event filter
            $q->when(isset($filters['is_event']), function ($q) use ($filters) {
                $q->whereHas('case', function($q) use ($filters) {
                    $q->where('is_event', $filters['is_event']);
                });
            });
        });
    }

}
