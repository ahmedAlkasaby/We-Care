<div class="modal fade" id="donationFilter" tabindex="-1" aria-labelledby="donationFilterLabel" aria-hidden="true">
    <form action="{{ route('donations.index') }}" method="get">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="padding-bottom: 10px;">
                    <h1 class="modal-title fs-5" id="caseFilterLabel">@lang('site.filters')</h1>
                    <button style="position: relative;" type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body border-top">
                    <div class="col-sm-12">
                        <label for="select2Icons" class="form-label">@lang('site.doner')</label>
                        <div class="position-relative">
                            <select name="doner_id" class="select2 form-select" tabindex="-1" aria-hidden="true">
                                <option value=" ">@lang('site.null')</option>
                                @foreach ($doners as $doner)
                                <option {{ request('doner_id')==$doner->id ? 'selected' : '' }} value="{{ $doner->id }}"
                                    >@lang('site.name') : {{ $doner->name }} //// @lang('site.phone') : {{ $doner->phone
                                    }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-12">
                        <label for="select2Icons" class="form-label">@lang('site.case')</label>
                        <div class="position-relative">
                            <select name="case_id" class="form-select select2" tabindex="-1" aria-hidden="true">
                                <option value=" ">@lang('site.null')</option>
                                @foreach ($cases as $case)
                                <option {{ request('case_id')==$case->id ? 'selected' :''}} value="{{ $case->id }}"
                                    >@lang('site.title') : {{ $case->user->name }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-12">
                        <label class="form-label">@lang('site.price')</label>
                        <input name="price" type="number" class="form-control" step="0.01"
                            value="{{ request('price') }}" />
                    </div>
                    <div class="col-12 col-md-12">
                        <label for="select2Icons" class="form-label">@lang('site.type_donation')</label>
                        <div class="position-relative">
                            <select name="type_donation" class="form-select select2" tabindex="-1" aria-hidden="true">
                                <option value="">@lang('site.null')</option>
                                <option value="price" {{ request('type_donation')=='price' ?'selected' :'' }}>
                                    @lang('site.price')</option>
                                <option value="items" {{ request('type_donation')=='items' ?'selected' :'' }}>
                                    @lang('site.items')</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('site.close')</button>
                    <button type="submit" class="btn btn-primary">@lang('site.filters')</button>
                </div>
            </div>
        </div>
    </form>
</div>
