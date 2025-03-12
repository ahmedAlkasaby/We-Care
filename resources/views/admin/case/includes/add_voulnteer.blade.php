<div class="modal fade" id="volunteer" tabindex="-1" aria-labelledby="volunteerLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content p-3 p-md-4">
            <div class="modal-header">
                <h5 class="modal-title" id="volunteerLabel">@lang('site.add volunteer')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body border-top">
                <form  action="{{route('volunteers.store')}}" method="POST" id="addUserForm" class="row g-3" enctype="multipart/form-data" >
                    @csrf
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="modalAddUserFirstName">@lang('site.volunteer name')</label>
                        <input type="text" id="modalAddUserFirstName" name="name" class="form-control" placeholder="@lang('site.volunteer name')" required>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="modalAddUserLang">@lang('site.volunteer lang')</label>
                        <select id="modalAddUserLang" name="lang" class="form-select" required>
                            <option value="ar">@lang('site.language arabic')</option>
                            <option value="en">@lang('site.language english')</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="modalAddUserPhone">@lang('site.volunteer phone')</label>
                        <input type="text" id="modalAddUserPhone" name="phone" class="form-control" placeholder="@lang('site.volunteer phone')" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="modalAddUserPassword">@lang('site.volunteer password')</label>
                        <input type="text" id="modalAddUserPassword" name="password" class="form-control" placeholder="@lang('site.volunteer password')" required>
                    </div>
                    <div class="col-sm-6" >
                        <label for="select2Icons" class="form-label">@lang('site.city_region')</label>
                        <div class="position-relative" >
                            <select id="select2Icons" name="region_id"
                                class="select2-icons form-select select2-hidden-accessible"
                                 tabindex="-1" aria-hidden="true">
                                 @foreach ($cities as $city)

                                 <optgroup label="{{ $city->nameLang() }}">
                                    @foreach ($city->regions as $region)
                                    <option {{ old('region_id')==$region->id ? 'selected' : '' }}value="{{ $region->id }}" >{{ $region->nameLang() }}</option>
                                    @endforeach
                                  </optgroup>

                                 @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary me-sm-3 me-1 waves-effect waves-light">@lang('site.add')</button>
                        <button type="reset" class="btn btn-label-secondary waves-effect" data-bs-dismiss="modal" aria-label="Close">@lang('site.discard')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
