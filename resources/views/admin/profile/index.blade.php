@extends('admin.master')

@section('html')
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}"
    class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" data-theme="theme-default"
    data-assets-path="../admin/assets/" data-template="vertical-menu-template">
@endsection

@section('title')
@lang('site.profile') - @lang('site.charity')
@endsection

@section('content')
<div class="container-fluid flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">{{ __('site.accountsettings') }} /</span> {{
        __('site.account') }}</h4>
    @include('admin.includes.success')

    <div class="row fv-plugins-icon-container">
        <div class="col-md-12">
            <ul class="nav nav-pills flex-column flex-md-row mb-4">
                <li class="nav-item">
                    <a class="nav-link active" href="javascript:void(0);">
                        <i class="ti-xs ti ti-users me-1"></i> {{ __('site.account') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('profile.security') }}">
                        <i class="ti-xs ti ti-lock me-1"></i> {{ __('site.security') }}
                    </a>
                </li>
            </ul>
            <div class="card mb-4">
                <h5 class="card-header">{{ __('site.profiledetails') }}</h5>
                <div class="card-body">
                    <hr class="my-0">
                    <div class="card-body">
                        <form action="{{url("dashboard/profile/$user->id")}}" method="POST"
                            enctype="multipart/form-data" class='needs-validation'> @csrf @method("PUT") <div
                                class="d-flex align-items-start align-items-sm-center gap-4"> @if($user->image) <img
                                    src="{{ asset('uploads/' . $user->image) }}" alt="user-avatar"
                                    class="d-block w-px-100 h-px-100 rounded" id="uploadedAvatar"> @else <img
                                    src="{{ asset('admin/assets/img/avatars/1.png') }}" alt="user-avatar"
                                    class="d-block w-px-100 h-px-100 rounded" id="uploadedAvatar"> @endif <div
                                    class="button-wrapper">
                                    <label for="upload" class="btn btn-primary me-2 mb-3 waves-effect waves-light"
                                        tabindex="0">
                                        <span class="d-none d-sm-block">{{ __('site.uploadimage') }}</span>
                                        <i class="ti ti-upload d-block d-sm-none"></i>
                                        <input type="file" id="upload" class="account-file-input" name="img"
                                            style="display: none;" accept="image/*">
                                    </label>
                                    <button type="button"
                                        class="btn btn-label-secondary account-image-reset mb-3 waves-effect">
                                        <i class="ti ti-refresh-dot d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">{{ __('site.reset') }}</span>
                                    </button>
                                    <div class="text-muted">{{ __('site.imageformats') }}</div>
                                </div>
                            </div>
                    </div>
                    <div class="row">
                        {{-- Name --}}
                        <div class="mb-3 col-md-6">
                            <label for="firstName" class="form-label">{{ __('site.name') }}</label>
                            <input class="form-control" type="text" id="firstName" name="name" value="{{ $user->name }}"
                                required>
                        </div>
                        {{-- Email --}}
                        <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">{{ __('site.email') }}</label>
                            <input class="form-control" type="email" id="email" name="email" value="{{ $user->email }}"
                                placeholder="john.doe@example.com">
                        </div>
                        {{-- Phone --}}
                        <div class="mb-3 col-md-6">
                            <label for="phoneNumber" class="form-label">{{ __('site.phone') }}</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text">EG (+20)</span>
                                <input type="text" id="phoneNumber" name="phone" class="form-control"
                                    value="{{ $user->phone }}" required>
                            </div>
                        </div>
                        {{-- City/Region --}}
                        <div class="mb-3 col-md-6">
                            <label for="select2Icons" class="form-label">@lang('site.city_region')</label>
                            <select id="address" name="region_id" class="form-select select2" tabindex="-1"
                                aria-hidden="true">
                                @foreach ($cities as $city)
                                <optgroup label="{{ $city->nameLang() }}">
                                    @foreach ($city->regions as $region)
                                    <option {{ old("region_id")==$region->id ? "selected" : "" }} value="{{
                                        $region->id }}">
                                        {{ $region->nameLang() }}
                                    </option>
                                    @endforeach
                                </optgroup>
                                @endforeach
                            </select>
                        </div>
                        {{-- Language --}}
                        <div class="mb-3 col-md-6">
                            <label for="language" class="form-label">{{ __('site.lang') }}</label>
                            <select name="lang" id="language" class="select2 form-select" required>
                                <option value="en" {{ $user->lang == 'en' ? 'selected' : '' }}>{{ __('site.english') }}
                                </option>
                                <option value="ar" {{ $user->lang == 'ar' ? 'selected' : '' }}>{{ __('site.arabic') }}
                                </option>
                            </select>
                        </div>
                        {{-- Save --}}
                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary me-2 waves-effect waves-light">{{
                                __('site.savechanges') }}</button>
                            <button type="reset" class="btn btn-label-secondary waves-effect">{{ __('site.cancel')
                                }}</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script>
    let accountUserImage = document.getElementById('uploadedAvatar');
    const fileInput = document.querySelector('.account-file-input'),
    resetFileInput = document.querySelector('.account-image-reset');

    if (accountUserImage) {
      const resetImage = accountUserImage.src;
      fileInput.onchange = () => {
        if (fileInput.files[0]) {
          accountUserImage.src = window.URL.createObjectURL(fileInput.files[0]);
        }
      };
      resetFileInput.onclick = () => {
        fileInput.value = '';
        accountUserImage.src = resetImage;
      };
    }
</script>
<script src={{ url("js/flashMessage.js")}}></script>
@endsection
