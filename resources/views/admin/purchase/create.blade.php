<div class="modal fade" id="purchase" tabindex="-1" aria-labelledby="purchaseLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content p-3 p-md-4">
            <div class="modal-header">
                <h5 class="modal-title" id="purchaseLabel">@lang('site.add_purchase')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body border-top">
                {!! Form::open(['route' => 'purchases.store', 'method' => 'POST', 'id' => 'addUserForm', 'class' => 'row g-3 needs-validation', 'enctype' => 'multipart/form-data']) !!}
                    <div class="col-12 col-md-12" >
                        <h5 class="modal-text">{{__('site.total money in safe')}} : {{$storage_money }}</h5>

                        <div class="repeater">
                            <div data-repeater-list="items">
                                <div class="row" data-repeater-item>
                                    <div class="col-md-4 mb-4">
                                        <div class="position-relative">
                                        <label for="select2Icons" class="form-label">@lang('site.item')</label>
                                            <select  name="item_id" class="form-select select2" >
                                                @foreach ($categories as $category)
                                                <optgroup label="{{ $category->nameLang() }}">
                                                    @foreach ($category->items as $item)
                                                    <option {{ old('item_id')==$item->id ? 'selected':'' }} value="{{ $item->id }}">{{ $item->nameLang() }}</option>
                                                    @endforeach
                                                </optgroup>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <label class="form-label">@lang('site.amount')</label>
                                        <input type="number" class="form-control" name="amount" value="0"  />
                                    </div>
                                    <div class="col-sm-3">
                                        <label class="form-label">@lang('site.unit_price')</label>
                                        <input type="number" class="form-control" name="unit_price" value="0"  />
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" data-repeater-delete class="btn btn-danger mt-4">@lang('site.delete')</button>
                                    </div>
                                </div>
                            </div>
                            <button type="button" data-repeater-create class="btn btn-primary mt-3">@lang('site.add_item')</button>
                        </div>
                    </div>
                    @include('admin.includes.form.submit-discard')

                    {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>