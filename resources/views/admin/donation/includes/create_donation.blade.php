<div id="itemsDonationSection" class="col-12 col-md-12" style="display: none;">
    <div class="repeater item-field mt-3">
        <div data-repeater-list="items">
            <div class="row" data-repeater-item>
                <div class="col-md-4 mb-4">
                    <label for="" class="form-label">@lang('site.item')</label>
                    <div class="position-relative">
                        <select name="item_id" class="select2 form-select">
                            @foreach ($categories as $category)
                            <optgroup label="{{ $category->nameLang() }}">
                                @foreach ($category->items as $item)
                                <option {{ old('item_id')==$item->id ? 'selected' : '' }} value="{{ $item->id }}">
                                    {{ $item->nameLang() }}
                                </option>
                                @endforeach
                            </optgroup>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-sm-4">
                    @include('admin.includes.form.text', ['label' => __('site.amount'), 'id' => 'amount-field', 'fieldName' => 'amount', 'fieldValue' => old('amount'), 'required' => true])
                </div>

                <div class="col-md-2">
                    <button type="button" data-repeater-delete class="btn btn-danger mt-4">@lang('site.delete')</button>
                </div>
            </div>
        </div>
        <button type="button" data-repeater-create class="btn btn-primary mt-3">@lang('site.add_item')</button>
    </div>
</div>
