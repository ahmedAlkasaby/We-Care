<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class CharityCase extends MainModel
{

    protected $fillable=[
        'volunteer_id',
        'category_case_id',
        'user_id',
        'name',
        'type',
        'description',
        'priority',
        'repeating',
        'next_donation_date',
        'active',
        'date_start',
        'date_end',
        'price',
        'price_raised',
        'is_event',
        'archive',
        'done',
        'order_no'
    ];


    public function details()
    {
        return $this->hasOne(CaseDetail::class,'case_id','id');
    }




    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function items()
    {
        return $this->belongsToMany(Item::class, 'charity_case_item')->withPivot('amount', 'amount_raised');
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'likes', 'case_id', 'user_id')->withTimestamps();
    }

    public function volunteer()
    {
        return $this->belongsTo(User::class,'volunteer_id','id');
    }
    public function category()
    {
        return $this->belongsTo(CategoryCase::class,'category_case_id','id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function is_archive()
    {
        if ($this->get_price_raised() >= $this->get_price()  || $this->archive == 1) {
            return true;
        }
        return false;
    }
    public function is_expire()
    {
        if ($this->date_end) {
            return now()->greaterThan($this->date_end);
        }
        return false;
    }

    public function this_case_need(){
        if($this->is_archive() || $this->is_expire() || $this->active == 0){
            return false;
        }else{
            return true;
        }

    }
    public function can_edit(){
        if ($this->transfers->count()<=0 && $this->donations->count()<=0 && $this->archive==0) {
            return true;
        }else {
            return false;
        }
    }

    public function check_status(){
        if ($this->repeating === 'none' && $this->archive==1 && $this->get_price_raised() >= $this->get_price()) {
            return __('site.finish');
        }elseif ($this->get_price_raised() < $this->get_price() && $this->date_end && $this->date_end < now()) {
            $this->active=0;
            $this->archive=1;
            $this->save();
            return __('site.expire');
        }elseif($this->archive==1) {
            return __('site.archive');
        }elseif ($this->done==0) {
            return __('site.not_done');
        }elseif ($this->active) {
            return __('site.active');
        }elseif($this->active == 0){
            return __('site.inactive');
        }
    }

    public function get_class_status($type){
        if($type===__('site.finish')){
            return "badge bg-label-primary";
        }elseif($type===__('site.expire')){
            return 'badge bg-label-warning';
        }elseif($type===__('site.archive')){
            return 'badge bg-label-dark';
        }elseif($type===__('site.active')){
            return 'badge bg-label-success';
        }elseif ($type===__('site.inactive')) {
            return 'badge bg-label-danger';
        }elseif ($type===__('site.not_done')) {
            return 'badge bg-label-info';
        }
    }

    public function getPriceAttribute(){
        if ($this->type=='price') {
            return $this->attributes['price'];
        }else{
            $totalPrice = $this->items->sum(function($item) {
                return $item->pivot->amount * $item->price;
            });

            $this->update(['price'=>$totalPrice]);
            return $this->attributes['price'];

        }
    }

    public function getPriceRaisedAttribute(){
        if ($this->type=='price') {
            return $this->attributes['price_raised'];

        }else{
            $price_raised=$this->items->sum(function($item){
                return $item->price * $item->pivot->amount_raised ;
            });

            $this->update(['price_raised'=>$price_raised]);

            return $this->attributes['price_raised'];

        }
    }

    public function get_price()
    {
        if ($this->type=='price') {
            return $this->attributes['price'];
        }else{
            $totalPrice = $this->items->sum(function($item) {
                return $item->pivot->amount * $item->price;
            });

            $this->update(['price'=>$totalPrice]);
            return $this->attributes['price'];

        }
    }

    public function get_price_raised()
    {
        if ($this->type=='price') {
            return $this->attributes['price_raised'];

        }else{
            $price_raised=$this->items->sum(function($item){
                return $item->price * $item->pivot->amount_raised ;
            });

            $this->update(['price_raised'=>$price_raised]);

            return $this->attributes['price_raised'];

        }
    }








    public function scopeApiFilter($query, $filters) {
        $query->where('active', 1)
              ->where('archive', 0)
              ->whereColumn('price_raised', '<', 'price')
              ->where(function($q) {
                  $q->whereNull('date_end')
                    ->orWhere('date_end', '>=', Carbon::now());
        });

        $query->where(function ($q) use ($filters) {
            // Date range filter

            $q->when(isset($filters['start_date']) && isset($filters['end_date']), function ($q) use ($filters) {
                $start = \Carbon\Carbon::parse($filters['start_date'])->format('Y-m-d');
                $end   = \Carbon\Carbon::parse($filters['end_date'])->format('Y-m-d');
                $q->whereBetween('date_end', [$start, $end]);
            });


            // Search filter
            $q->when(isset($filters['search']), function ($q) use ($filters) {
                $q->where(function($q) use ($filters) {
                    $q->where('name', 'like', '%'.$filters['search'].'%')
                      ->orWhere('description', 'like', '%'.$filters['search'].'%');
                });
            });

            // City filter
            $q->when(isset($filters['city_id']), function ($q) use ($filters) {
                $q->whereHas('user', function ($q) use ($filters) {
                    $q->where('city_id', $filters['city_id']);
                });
            });

            // Region filter
            $q->when(isset($filters['region_id']), function ($q) use ($filters) {
                $q->whereHas('user', function ($q) use ($filters) {
                    $q->where('region_id', $filters['region_id']);
                });
            });

            // Price need filter
            $q->when(isset($filters['min_price_need']) || isset($filters['max_price_need']), function ($q) use ($filters) {
                $min = $filters['min_price_need'] ?? 0; // القيمة الصغرى الافتراضية 0 إذا لم يتم تحديدها
                $max = $filters['max_price_need'] ?? PHP_INT_MAX; // القيمة العظمى الافتراضية هي الحد الأقصى للعدد الصحيح في PHP

                $q->whereRaw('(price - price_raised) BETWEEN ? AND ?', [$min, $max]);

            });


            // Category filter
            $q->when(isset($filters['category_id']), function ($q) use ($filters) {
                $q->where('category_case_id', $filters['category_id']);
            });

            // Urgent filter
            $q->when(isset($filters['is_urgent']) && $filters['is_urgent'] === 1, function ($q) {
                $q->where('priority', 'high');
            });

            // Ending soon filter
            $q->when(isset($filters['is_ending']) && $filters['is_ending'] === 1, function ($q) {

                $q->whereBetween('date_end', [Carbon::now(), Carbon::now()->addWeek()]);
            });

            // Event filter
            $q->when(isset($filters['is_event']), function ($q) use ($filters) {
                $q->where('is_event', $filters['is_event']);
            });
        });

        $query->orderByRaw('ISNULL(order_no), order_no ASC, created_at ' . ($filters['order_by'] ?? 'DESC'));

    }

    public function scopeFilter($query,  $search=null, $volunteer_id=null, $category_case_id=null, $priority=null, $repeating=null, $next_donation_date=null, $date_end=null,$active=null, $city_id=null, $region_id=null, $price=null, $price_raised=null, $has_items=null, $price_need=null, $is_event=null,$status=null)
    {
        $query->whereNull('deleted_at');

        $query->when($search, function ($q, $search) {
            $q->where(function($q) use ($search) {
                $q->whereHas('user', function($q) use($search) {
                    $q->where('name', 'like', '%'.$search.'%')
                       ->orWhere('phone', 'like', '%'.$search.'%')
                       ->orWhere('email', 'like', '%'.$search.'%');
                });
                $q->orWhereHas('details', function($q) use($search) {
                    $q->where('code_name', 'like', '%'.$search.'%')
                       ->orWhere('national_number', 'like', '%'.$search.'%')
                       ->orWhere('condition', 'like', '%'.$search.'%')
                       ->orWhere('type_of_aid', 'like', '%'.$search.'%')
                       ->orWhere('area', 'like', '%'.$search.'%')
                       ->orWhere('street', 'like', '%'.$search.'%')
                       ->orWhere('district', 'like', '%'.$search.'%')
                       ->orWhere('building', 'like', '%'.$search.'%')
                       ->orWhere('floor', 'like', '%'.$search.'%')
                       ->orWhere('apartment', 'like', '%'.$search.'%');
                });
            });
        });

        $query->when($volunteer_id, function ($q, $volunteer_id) {
            $q->where('volunteer_id', $volunteer_id);
        });

        $query->when($category_case_id, function ($q, $category_case_id) {
            $q->where('category_case_id', $category_case_id);
        });

        $query->when($priority, function ($q, $priority) {
            $q->where('priority', $priority);
        });

        $query->when($repeating, function ($q, $repeating) {
            $q->where('repeating', $repeating);
        });

        $query->when($next_donation_date, function ($q, $next_donation_date) {
            $q->whereDate('next_donation_date', '<=', $next_donation_date)
              ->orderBy('next_donation_date', 'asc');
        });

        $query->when($date_end, function ($q, $date_end) {
            $q->whereDate('date_end', '<=', $date_end)
              ->orderBy('date_end', 'asc');
        });

        $query->when(!is_null($active), function ($q) use ($active) {
            $q->where('active', (bool)$active);
        });

        $query->when($city_id, function ($q, $city_id) {
            $q->whereHas('user', function ($q) use ($city_id) {
                $q->where('city_id', $city_id)
                  ->whereNull('deleted_at');
            });
        });

        $query->when($region_id, function ($q, $region_id) {
            $q->whereHas('user', function ($q) use ($region_id) {
                $q->where('region_id', $region_id)
                  ->whereNull('deleted_at');
            });
        });

        $query->when($price, function ($q, $price) {
            $q->where('price', '>=', $price);
        });

        $query->when($price_raised, function ($q, $price_raised) {
            $q->where('price_raised', '>=', $price_raised);
        });

        $query->when(!is_null($has_items), function ($q) use ($has_items) {
            if ($has_items == 'items') {
                $q->has('items');
            } elseif ($has_items == 'price') {
                $q->doesntHave('items');
            }
        });

        $query->when($price_need, function ($q, $price_need) {
            if ($this->type == 'price') {
                $q->whereRaw('price - price_raised >= ?', [$price_need]);
            } else {
                $q->whereHas('items', function($q) use ($price_need) {
                    $q->whereRaw('(items.price * (amount - amount_raised)) >= ?', [$price_need]);
                });
            }
        });

        $query->when(!is_null($is_event), function ($q) use ($is_event) {
            $q->where('is_event', (bool)$is_event);
        });

        $query->when(!is_null($status),function($q) use ($status){
            if ($status=='need') {
                $q->where(function ($subQuery) {
                    $subQuery->whereNull('date_end')->orWhere('date_end','>',now());
                })->where('price', '>', 'price_raised')->where('archive',0);
            }elseif($status=='finish'){
                $q->whereRaw('price_raised >= price');
            }elseif ($status=='archive') {
                $q->where('archive',1);
            }elseif ($status=='ending') {
                $q->where('archive',0)->whereBetween('date_end', [Carbon::now(), Carbon::now()->addWeek()]);
            }elseif ($status=='expire') {
                $q->where('date_end', '<', now())->whereRaw('price_raised < price');
            }elseif ($status='repeating') {
                $q->where('repeating' ,'!=','none');
            }
        });

        $query->orderByRaw('ISNULL(order_no), order_no ASC, created_at ' . ('DESC'));
    }



    public function transfers() {
        return $this->hasMany(Transfer::class,'case_id','id');
    }
    public function donations() {
        return $this->hasMany(Donation::class,'case_id','id');
    }

    public function transferCount(){
        return $this->transfers()->count();
    }


}
