@if (request()->routeIs('cases.edit'))
<div id="case-need-validation" class="content">
    <div class="content-header mb-3">
        <h6 class="mb-0">@lang('site.case_need')</h6>
        <small>@lang('site.enter_case_need')</small>
    </div>
    <div class="col-sm-12">
        <div class="position-relative">
            @include('admin.includes.form.select', [
            'label' => __('site.active'),
            'id' => 'active-select',
            'fieldName' => 'active',
            'options' => [
            '1' => __('site.yes'),
            '0' => __('site.no'),
            ],
            'fieldValue' => $case->active,
            'class' => 'form-select select2',
            'required' => true
            ])

        </div>
    </div>
    <br>
    <input type="hidden" value="{{ $case->items->count() > 0 ? 'item' : 'price' }}" id="currentMode">
    @if ($case->items->count() > 0)
    <div class="row g-3">
        <!-- زرار اختيار بين items و price -->
        <div class="btn-group mt-3" role="group">
            <button type="button" class="btn btn-primary" id="item-btn">@lang('site.items')</button>
            <button type="button" class="btn btn-secondary" id="price-btn">@lang('site.price')</button>
        </div>

        <!-- Price field -->
        <div class="col-sm-8 price-field d-none mt-3">
            @include('admin.includes.form.text', [
            'label' => __('site.price'),
            'id' => 'price-field',
            'fieldName' => 'price',
            'fieldValue' => old('price'),
            'step' => 0.01,
            'required' => true
            ])

        </div>
        <!-- قسم items -->
        <div class="repeater item-field d-none mt-3">
            <div data-repeater-list="items">
                @foreach ($case->items as $i)
                <div class="row" data-repeater-item>
                    <div class="col-md-4 mb-4">
                        <label for="select2Icons" class="form-label">@lang('site.item')</label>
                        <div class="position-relative">
                            <select id="" name="item_id" class="form-select select2" required>
                                @foreach ($categories as $category)
                                <optgroup label="{{ $category->nameLang() }}">
                                    @foreach ($category->items as $item)
                                    <option {{ $i->id == $item->id ? 'selected' : '' }}
                                        value="{{ $item->id }}">{{ $item->nameLang() }}
                                    </option>
                                    @endforeach
                                </optgroup>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        @include('admin.includes.form.number', [
                        'label' => __('site.amount'),
                        'id' => 'amount-field',
                        'fieldName' => 'amount',
                        'fieldValue' => $i->pivot->amount - $i->pivot->amount_raised,
                        "class"=>"form-control",
                        "place"=>null,
                        'required' => true
                        ])

                    </div>
                    <div class="col-md-2">
                        <button type="button" data-repeater-delete
                            class="btn btn-danger mt-4">@lang('site.delete')</button>
                    </div>
                </div>
                @endforeach
            </div>
            <button type="button" data-repeater-create class="btn btn-primary mt-3">@lang('site.add_item')</button>
        </div>

        <div class="col-12 d-flex justify-content-between">
            <button class="btn btn-label-secondary btn-prev" onclick="event.preventDefault();">
                <i class="ti ti-arrow-left me-sm-1 me-0"></i>
                <span class="align-middle d-sm-inline-block d-none">@lang('site.previous')</span>
            </button>
            <button class="btn btn-success btn-submit">@lang('site.submit')</button>
        </div>


    </div>
    @else
    <div class="row g-3">
        <div class="btn-group mt-3" role="group">
            <button type="button" class="btn btn-primary active" id="item-btn">@lang('site.item')</button>
            <button type="button" class="btn btn-secondary" id="price-btn">@lang('site.price')</button>
        </div>

        <!-- Price field -->
        <div class="col-sm-8 price-field d-none mt-3">
            @include('admin.includes.form.text', [
            'label' => __('site.price'),
            'id' => 'price-field',
            'fieldName' => 'price',
            'fieldValue' => $case->price,
            'place' => __('site.Enter price'), // Optional placeholder
            'required' => true
            ])

        </div>

        <!-- Item repeater field -->
        <div class="repeater item-field d-none mt-3">
            <div data-repeater-list="items">
                <div class="row" data-repeater-item>
                    <div class="col-md-4 mb-4">
                        <label class="form-label">@lang('site.item')</label>
                        <div class="position-relative">
                            <select name="item_id" class="form-select">
                                @foreach ($categories as $category)
                                <optgroup label="{{ $category->nameLang() }}">
                                    @foreach ($category->items as $item)
                                    <option {{ old('item_id')==$item->id ? 'selected':'' }}
                                        value="{{ $item->id }}">{{ $item->nameLang() }}
                                    </option>
                                    @endforeach
                                </optgroup>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        @include('admin.includes.form.text', [
                        'label' => __('site.amount'),
                        'id' => 'amount-field',
                        'fieldName' => 'amount',
                        'fieldValue' => old('amount'),
                        'place' => __('site.Enter amount'), // Optional placeholder
                        'required' => true
                        ])
                    </div>
                    <div class="col-md-2">
                        <button type="button" data-repeater-delete
                            class="btn btn-danger mt-4">@lang('site.delete')</button>
                    </div>
                </div>
            </div>
            <button type="button" data-repeater-create class="btn btn-primary mt-3">@lang('site.add_item')</button>
        </div>

        <div class="col-12 d-flex justify-content-between">
            <button class="btn btn-label-secondary btn-prev" onclick="event.preventDefault();">
                <i class="ti ti-arrow-left me-sm-1 me-0"></i>
                <span class="align-middle d-sm-inline-block d-none">@lang('site.previous')</span>
            </button>
            <button class="btn btn-success btn-submit">@lang('site.submit')</button>
        </div>
    </div>
    @endif
</div>
@else
<div id="case-need-validation" class="content">
    <div class="content-header mb-3">
        <h6 class="mb-0">@lang("site.case_need")</h6>
        <small>@lang("site.enter_case_need")</small>
    </div>
    <div class="row g-3">
        <div class="btn-group mt-3" role="group">
            <button type="button" class="btn btn-primary active" id="item-btn">@lang("site.item")</button>
            <button type="button" class="btn btn-secondary" id="price-btn">@lang("site.price")</button>
        </div>

        <!-- Price field -->
        <div class="col-sm-8 price-field d-none mt-3">
            @include('admin.includes.form.text', [
            'label' => __('site.price'),
            'id' => 'price-field',
            'fieldName' => 'price',
            'fieldValue' => old('price'),
            'step' => 0.5,
            'required' => true
            ])
        </div>

        <!-- Item repeater field -->
        <div class="repeater item-field d-none mt-3">
            <div data-repeater-list="items">
                <div class="row" data-repeater-item>
                    <div class="col-md-4 mb-4">
                        <label class="form-label">@lang("site.item")</label>
                        <div class="position-relative">
                            <select name="item_id" class="select2 form-select">
                                @foreach ($categories as $category)
                                <optgroup label="{{ $category->nameLang() }}">
                                    @foreach ($category->items as $item)
                                    <option {{ old("item_id")==$item->id ? "selected":"" }}
                                        value="{{ $item->id }}">{{ $item->nameLang() }}</option>
                                    @endforeach
                                </optgroup>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        @include('admin.includes.form.text', [
                        'label' => __('site.amount'),
                        'id' => 'amount-field',
                        'fieldName' => 'amount',
                        'fieldValue' => old('amount'),
                        'required' => true
                        ])

                    </div>

                    <div class="col-md-2">
                        <button type="button" data-repeater-delete
                            class="btn btn-danger mt-4">@lang("site.delete")</button>
                    </div>
                </div>
            </div>
            <button type="button" data-repeater-create class="btn btn-primary mt-3">@lang("site.add_item")</button>
        </div>

        <div class="col-12 d-flex justify-content-between">
            <button class="btn btn-label-secondary btn-prev" onclick="event.preventDefault();">
                <i class="ti ti-arrow-left me-sm-1 me-0"></i>
                <span class="align-middle d-sm-inline-block d-none">@lang("site.previous")</span>
            </button>

            <button class="btn btn-success btn-submit waves-effect waves-light">{{ __('site.submit')}}</button>
        </div>
    </div>
</div>
@endif