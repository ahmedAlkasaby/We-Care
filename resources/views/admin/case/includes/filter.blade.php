<div class="modal fade" id="casesFilter" tabindex="-1" aria-labelledby="casesFilterLabel" aria-hidden="true">
    <form action="{{ route('cases.index') }}" method="get">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header" style="padding-bottom: 15px;">
              <h1 class="modal-title fs-5" id="caseFilterLabel">@lang('site.filters')</h1>
              <button type="button" class="btn-close position-relative" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body border-top pb-0 pt-1">

                <div class="row mb-2">
                    <div class="col-sm-6" >


                        @include('admin.includes.form.select', [
                            'label' => __('site.status'),
                            'id' => 'status',
                            'fieldName' => 'status',
                            'options' => [
                                'need'=>__('site.needed_cases'),
                                'repeating'=>__('site.repeating_cases'),
                                'finish'=>__('site.finish_cases'),
                                'expire'=>__('site.expire_cases'),
                                'ending'=>__('site.ending_cases'),
                                'archive'=>__('site.archive_cases'),
                            ],
                            'fieldValue' => request('status'),
                            'class' => 'form-select select2',
                            'required' => false
                        ])

                    </div>
                    <div class="col-sm-6" >
                        @include('admin.includes.form.select', [
                            'label' => __('site.volunteer'),
                            'id' => 'select2Basic',
                            'fieldName' => 'volunteer_id',
                            'options' => $volunteersOptions,
                            'fieldValue' => request('volunteer_id'),
                            'class' => 'select2 form-select form-select-lg',
                            'required' => false
                        ])
                    </div>

                </div>

                <div class="row mb-2">


                    <div class="col-sm-6" >
                        @include('admin.includes.form.select', [
                            'label' => __('site.active'),
                            'id' => 'activeSelect',
                            'fieldName' => 'active',
                            'options' => [
                                '0' => __('site.no'),
                                '1' => __('site.yes'),
                            ],
                            'fieldValue' => request('active'),
                            'class' => 'select2 form-select',
                            'required' => false
                        ])
                    </div>
                    <div class="col-sm-6" >
                        @include('admin.includes.form.select', [
                            'label' => __('site.is_event'),
                            'id' => 'isEventSelect',
                            'fieldName' => 'is_event',
                            'options' => [
                                '0' => __('site.no'),
                                '1' => __('site.yes'),
                            ],
                            'fieldValue' => request('is_event'),  // القيمة المحددة من الطلب
                            'class' => 'select2 form-select',
                            'required' => false // اجعلها true إذا كانت مطلوبة
                        ])

                    </div>

                </div>

                <div class="row mb-2">

                    <div class="col-sm-6" >
                        @include('admin.includes.form.select', [
                            'label' => __('site.cities'),
                            'id' => 'citySelect',
                            'fieldName' => 'city_id',
                            'options' => $city_array, // تحديد الخيارات باستخدام pluck
                            'fieldValue' => request('city_id'),  // القيمة المحددة من الطلب
                            'class' => 'select2 form-select',
                            'required' => false // اجعلها true إذا كانت مطلوبة
                        ])
                    </div>

                    <div class="col-sm-6" >
                        <label for="" class="form-label">@lang('site.region')</label>
                        <div class="position-relative" >
                            <select   name="region_id"
                                class="select2 form-select"
                                 tabindex="-1" aria-hidden="true">
                                 <option value="">@lang('site.region')</option>
                                 @foreach ($cities as $city)
                                 <optgroup label="{{ $city->nameLang() }}">
                                    @foreach ($city->regions as $region)
                                    <option value="{{ $region->id }}" {{ request('region_id')==$region->id ? 'selected' :'' }}>{{ $region->nameLang() }}</option>
                                    @endforeach
                                  </optgroup>
                                 @endforeach
                            </select>
                        </div>
                    </div>



                </div>

                <div class="row mb-2 ">
                    <div class="col-sm-4" >
                        @include('admin.includes.form.select', [
                            'label' => __('site.priority'),
                            'id' => 'prioritySelect',
                            'fieldName' => 'priority',
                            'options' => [
                                'medium' => __('site.medium'),
                                'high' => __('site.high'),
                                'low' => __('site.low'),
                            ],
                            'fieldValue' => request('priority'),  // القيمة المحددة من الطلب
                            'class' => 'select2 form-select',
                            'required' => false // اجعلها true إذا كانت مطلوبة
                        ])
                    </div>
                    <div class="col-sm-4" >
                        @include('admin.includes.form.select', [
                            'label' => __('site.category_case'),
                            'id' => 'categoryCaseSelect',
                            'fieldName' => 'category_case_id',
                            'options' => $category_array, // تحديد الخيارات باستخدام pluck
                            'fieldValue' => request('category_case_id'),  // القيمة المحددة من الطلب
                            'class' => 'select2 form-select',
                            'required' => false // اجعلها true إذا كانت مطلوبة
                        ])
                    </div>
                    <div class="col-sm-4" >
                        @include('admin.includes.form.select', [
                            'label' => __('site.repeating'),
                            'id' => 'repeatingSelect',
                            'fieldName' => 'repeating',
                            'options' => [
                                'none' => __('site.none'),
                                'daily' => __('site.daily'),
                                'weekly' => __('site.weekly'),
                                'monthly' => __('site.monthly'),
                                'yearly' => __('site.yearly'),
                            ], // تعيين الخيارات هنا
                            'fieldValue' => request('repeating'),  // القيمة المحددة من الطلب
                            'class' => 'select2 form-select',
                            'required' => false // اجعلها true إذا كانت مطلوبة
                        ])
                    </div>


                </div>

                <div class="row mb-2 ">
                    <div class="col-sm-4">
                        @include('admin.includes.form.number', [
                            'label' => __('site.price'),
                            'fieldName' => 'price',
                            'fieldValue' =>  request('price') ,
                            'class' => 'form-control',
                            {{-- 'required' => false --}}
                        ])

                    </div>
                    <div class="col-sm-4">
                        @include('admin.includes.form.number', [
                            'label' => __('site.price_raised'),
                            'fieldName' => 'price_raised',
                            'fieldValue' =>  request('price_raised') ,
                            'class' => 'form-control',
                            {{-- 'required' => false --}}
                            ])
                    </div>
                    <div class="col-sm-4" >
                        @include('admin.includes.form.select', [
                            'label' => __('site.type_case'),
                            'id' => 'typeSelect',
                            'fieldName' => 'type',
                            'options' => [
                                'price' => __('site.price'),
                                'items' => __('site.items'),
                            ],
                            'fieldValue' => request('type'),
                            'class' => 'select2 form-select',
                            'required' => false
                        ])
                    </div>
                </div>

                <div class="row mb-2 ">

                    <div class="col-sm-6" >
                        @include('admin.includes.form.date', [
                            'label' => __('site.next_donation_date'),
                            'fieldName' => 'next_donation_date',
                            'fieldValue' =>  request('next_donation_date') ,
                            'class' => 'form-control',
                            {{-- 'required' => false --}}
                        ])

                    </div>
                    <div class="col-sm-6" >
                        @include('admin.includes.form.date', [
                            'label' => __('site.date_end'),
                            'fieldName' => 'date_end',
                            'fieldValue' =>  request('date_end') ,
                            'class' => 'form-control',
                            {{-- 'required' => false --}}
                        ])

                    </div>
                </div>

            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('site.close')</button>
              {{-- <button type="button" id="filter-submit-btn" class="btn btn-primary" data-bs-dismiss="modal">@lang('site.filters')</button> --}}
              <button type="submit"  class="btn btn-primary" >@lang('site.filters')</button>
            </div>
          </div>
        </div>
    </form>
</div>
