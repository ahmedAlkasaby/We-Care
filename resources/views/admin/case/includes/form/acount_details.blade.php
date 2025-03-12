<div id="account-details-validation" class="content">
    <div class="content-header mb-3">
        <h6 class="mb-0">@lang("site.acount_details")</h6>
        <small>@lang("site.enter_acount_details")</small>
    </div>
    <div class="row g-3">
        <div class="col-sm-6">
            @include('admin.includes.form.text', ['label' => __('site.name'),'fieldName' => 'name','fieldValue' =>request()->routeIs('cases.create') ? old('name') : $case->user->name,'required' => true])
        </div>
        <div class="col-sm-6">
            @include('admin.includes.form.number', ['label' => __('site.phone'),'fieldName' => 'phone','fieldValue' =>request()->routeIs('cases.create') ? old('phone') : $case->user->phone ])
        </div>

        <div class="col-sm-6">
            @include('admin.includes.form.select', ['label' => __('site.gender'),'fieldName' => 'gender','options' => ['male' => __('site.male'), 'female' => __('site.female')],'fieldValue' => request()->routeIs('cases.create') ? old('gender') : $case->user->gender,'class' => 'form-select ','required' => true])
        </div>

        <div class="col-sm-6">
            @include('admin.includes.form.select', ['label' => __('site.address'),'fieldName' => 'region_id','options' =>  $cities->mapWithKeys(function ($city) {
                return [
                    $city->nameLang() => $city->regions->mapWithKeys(function ($region) {
                        return [$region->id => $region->nameLang()];
                    })->toArray(),
                ];
            })->toArray(),'fieldValue' =>request()->routeIs('cases.create') ? old('region_id') : $case->user->region_id,'class' => 'form-select select2','required' => true])
        </div>

        <div class="col-sm-6">
            @include('admin.includes.form.text', ['label' => __('site.code_name'),'fieldName' => 'code_name','fieldValue' =>request()->routeIs('cases.create') ? old('code_name') :  optional($case->details)->code_name,'required' => false])
        </div>
        <div class="col-sm-6">
            @include('admin.includes.form.number', ['label' => __('site.national_number'),'fieldName' => 'national_number','fieldValue' =>request()->routeIs('cases.create') ? old('national_number') :  optional($case->details)->national_number ])

        </div>
        <div class="col-sm-6">
            @include('admin.includes.form.text', ['label' => __('site.condition'),'fieldName' => 'condition','fieldValue' =>request()->routeIs('cases.create') ? old('condition') :  optional($case->details)->condition,'required' => false])
        </div>

        <div class="col-sm-6">
            @include('admin.includes.form.number', ['label' => __('site.number_of_peaple'),'fieldName' => 'number_of_peaple','fieldValue' =>request()->routeIs('cases.create') ? old('number_of_peaple') :  optional($case->details)->number_of_peaple])
        </div>
        {{-- <div class="col-sm-6">
            @include('admin.includes.form.text', ['label' => __('site.government'),'fieldName' => 'government','fieldValue' =>request()->routeIs('cases.create') ? old('government') :  optional($case->details)->government ,'required' => false])

        </div>
        <div class="col-sm-6">
            @include('admin.includes.form.text', ['label' => __('site.city'),'fieldName' => 'city','fieldValue' =>request()->routeIs('cases.create') ? old('city') :  optional($case->details)->city,'required' => false])
        </div> --}}
        <div class="col-sm-6">
            @include('admin.includes.form.text', ['label' => __('site.area'),'fieldName' => 'area','fieldValue' =>request()->routeIs('cases.create') ? old('area') :  optional($case->details)->area ,'required' => false])

        </div>
        <div class="col-sm-6">
            @include('admin.includes.form.text', ['label' => __('site.street'),'fieldName' => 'street','fieldValue' =>request()->routeIs('cases.create') ? old('street') :  optional($case->details)->street ,'required' => false])

        </div>
        <div class="col-sm-6">
            @include('admin.includes.form.text', ['label' => __('site.district'),'fieldName' => 'district','fieldValue' =>request()->routeIs('cases.create') ? old('district') :  optional($case->details)->district ,'required' => false])

        </div>
        <div class="col-sm-6">
            @include('admin.includes.form.text', ['label' => __('site.building'),'fieldName' => 'building','fieldValue' =>request()->routeIs('cases.create') ? old('building') :  optional($case->details)->building ,'required' => false])

        </div>
        <div class="col-sm-6">
            @include('admin.includes.form.text', ['label' => __('site.floor'),'fieldName' => 'floor','fieldValue' =>request()->routeIs('cases.create') ? old('floor') :  optional($case->details)->floor ,'required' => false])

        </div>
        <div class="col-sm-6">
            @include('admin.includes.form.text', ['label' => __('site.apartment'),'fieldName' => 'apartment','fieldValue' =>request()->routeIs('cases.create') ? old('apartment') :  optional($case->details)->apartment ,'required' => false])

        </div>


        <div class="col-12 d-flex justify-content-between">
            <button class="btn btn-label-secondary btn-prev" disabled
                onclick="event.preventDefault();">
                <i class="ti ti-arrow-left me-sm-1 me-0"></i>
                <span
                    class="align-middle d-sm-inline-block d-none">@lang("site.previous")</span>
            </button>
            <button class="btn btn-primary btn-next" onclick="event.preventDefault();">
                <span
                    class="align-middle d-sm-inline-block d-none me-sm-1">@lang("site.next")</span>
                <i class="ti ti-arrow-right"></i>
            </button>
        </div>
    </div>
</div>
