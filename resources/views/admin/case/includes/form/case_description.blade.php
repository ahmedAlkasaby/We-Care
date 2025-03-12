<div id="case-description-validation" class="content">
    <div class="content-header mb-3">
        <h6 class="mb-0">@lang("site.case_description")</h6>
        <small>@lang("site.add_case_description")</small>
    </div>

    <div class="row g-3">
        <div class="col-sm-12 d-flex align-items-center">
            <div class="row g-3">
                <div class="col-sm-12">
                    @include('admin.includes.form.select', ['label' => __('site.volunteer'),'fieldName' => 'volunteer_id','options' =>$volunteers,'fieldValue' =>request()->routeIs('cases.create') ? old('volunteer_id') : $case->volunteer_id,'class' => 'form-select select2','required' => false])
                </div>
                <div class="col-sm-6">
                    @include('admin.includes.form.select', ['label' => __('site.category_case'),'fieldName' => 'category_case_id','options' =>$case_categories,'fieldValue' =>request()->routeIs('cases.create') ? old('category_case_id') : $case->category_case_id,'class' => 'form-select','required' => true])
                </div>
                <div class="col-sm-6">
                    @include('admin.includes.form.select', ['label' => __('site.is_event'),'fieldName' => 'is_event','options' =>['0'=>__('site.no'),'1'=>__('site.yes')],'fieldValue' =>request()->routeIs('cases.create') ? old('is_event') : $case->is_event,'class' => 'form-select ','required' => true])
                </div>
                <div class="col-sm-6">
                    @include('admin.includes.form.select', ['label' => __('site.priority'),'fieldName' => 'priority','options' =>['high'=>__('site.high'),'medium'=>__('site.medium'),'low'=>__('site.low')],'fieldValue' =>request()->routeIs('cases.create') ? old('priority') : $case->priority,'class' => 'form-select ','required' => true])
                </div>
                <div class="col-sm-6">
                    @include('admin.includes.form.select', ['label' => __('site.repeating'),'fieldName' => 'repeating','options' =>['none'=>__('site.none'),'daily'=>__('site.daily'),'weekly'=>__('site.weekly'),'monthly'=>__('site.monthly'),'yearly'=>__('site.yearly')],'fieldValue' =>request()->routeIs('cases.create') ? old('repeating') : $case->repeating,'class' => 'form-select','required' => true])
                </div>
                <div class="col-sm-6">
                    @include('admin.includes.form.text', ['label' => __('site.title_ar'),'fieldName' => 'title_ar','fieldValue' =>request()->routeIs('cases.create') ?old("title_ar") : $case->nameLang('ar') ,'required' => true])
                </div>
                <div class="col-sm-6">
                    @include('admin.includes.form.text', ['label' => __('site.title_en'),'fieldName' => 'title_en','fieldValue' =>request()->routeIs('cases.create') ?old("title_en") : $case->nameLang('en'),'required' => true])

                </div>
                <div>
                    @include('admin.includes.form.textarea', ['label' => __('site.Description ar'),'fieldName' => 'description_ar','rows' => 4,'fieldValue'=>request()->routeIs('cases.create') ? old('description_ar'): $case->descriptionLang('ar')])
                </div>
                <div>
                    @include('admin.includes.form.textarea', ['label' => __('site.Description en'),'fieldName' => 'description_en','rows' => 4,'fieldValue'=>request()->routeIs('cases.create') ? old('description_en'): $case->descriptionLang('en')])

                </div>
                <div class="row">
                    <div class="col-md-6 mb-6">
                        <label for="date-input" class="form-label">@lang("site.date_end")</label>
                        <input type="date" id="date-input" class="form-control" name="date_end" value="{{ request()->routeIs('cases.create') ? old('date_end') : ($case->date_end ? \Carbon\Carbon::parse($case->date_end)->format('Y-m-d') : '') }}">
                    </div>
                    <div class="col-sm-6">
                        @include('admin.includes.form.number', ['label' => __('site.order_no'),'fieldName' => 'order_no','fieldValue' =>request()->routeIs('cases.create') ? old('order_no') : $case->order_no ])
                    </div>
                </div>
                <div class="mb-3">
                    <label for="images" class="form-label">@lang("site.upload_images")</label>
                    <input type="file" class="form-control" id="images" name="images[]" multiple
                        accept="image/*">
                </div>
                @if (request()->routeIs('cases.edit'))
                @if(count($case->images) > 0)
                <div class="mb-3">
                    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel"
                        style="max-width: 400px; margin: 0 auto;">
                        <div class="carousel-inner">
                            @foreach ($case->images as $image)
                            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                <img src="{{ asset('uploads/' . $image->image) }}"
                                    class="d-block w-100 rounded img-fluid"
                                    alt="Image {{ $loop->index }}">
                            </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button"
                            data-bs-target="#carouselExample" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">@lang('site.previous')</span>
                        </button>
                        <button class="carousel-control-next" type="button"
                            data-bs-target="#carouselExample" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">@lang('site.next')</span>
                        </button>
                    </div>
                </div>
                @endif

                @endif
                <div class="col-12 d-flex justify-content-between">
                    <button class="btn btn-primary btn-prev" onclick="event.preventDefault();">
                        <i class="ti ti-arrow-left me-sm-1 me-0"></i>
                        <span class="align-middle d-sm-inline-block d-none">@lang("site.previous")</span>
                    </button>
                    <button class="btn btn-primary btn-next" onclick="event.preventDefault();">
                        <span class="align-middle d-sm-inline-block d-none me-sm-1">@lang("site.next")</span>
                        <i class="ti ti-arrow-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
