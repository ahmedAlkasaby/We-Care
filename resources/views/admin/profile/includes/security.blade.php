@extends('admin.master')

@section('html')
<html
lang="{{ app()->getLocale() }}"
dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}"
class="light-style layout-navbar-fixed layout-menu-fixed layout-compact"
data-theme="theme-default"
data-assets-path="../../admin/assets/"
data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
@endsection

@section('title')
@lang('site.profile') - @lang('site.charity')
@endsection

@section('content')
      <div class="container-fluid flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">{{__('site.accountsettings')}} /</span> {{__('site.security')}}</h4>

    <div class="row">
      <div class="col-md-12">

        <ul class="nav nav-pills flex-column flex-md-row mb-4">
          <li class="nav-item">
            <a class="nav-link" href="{{url("dashboard/profile")}}"><i class="ti-xs ti ti-users me-1"></i> {{__('site.account')}}</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="javascript:void(0);"><i class="ti-xs ti ti-lock me-1"></i> {{__('site.security')}}</a>
          </li>

          {{-- Additional progfile pages if needed --}}
            {{-- <li class="nav-item">
                    <a class="nav-link" href="pages-account-settings-billing.html"><i class="ti-xs ti ti-file-description me-1"></i> Billing &amp; Plans</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pages-account-settings-notifications.html"><i class="ti-xs ti ti-bell me-1"></i> Notifications</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pages-account-settings-connections.html"><i class="ti-xs ti ti-link me-1"></i> Connections</a>
            </li> --}}
        </ul>

        <!-- Change Password -->
        <div class="card mb-4">
          <h5 class="card-header">{{__('site.change password')}}</h5>

          @include('admin.includes.displayErrors')
          @include('admin.includes.success')

          <div class="card-body">
            <form id="formAccountSettings" method="POST" action="{{url("dashboard/profile/security/updatePassword")}}" class="fv-plugins-bootstrap5 fv-plugins-framework">
                @csrf
                <div class="row">
                <div class="mb-3 col-md-6 form-password-toggle fv-plugins-icon-container">
                  <label class="form-label" for="currentPassword">{{__('site.current password')}}</label>
                  <div class="input-group input-group-merge has-validation">
                    <input class="form-control" type="password" name="currentPassword" id="currentPassword" placeholder="············">
                    <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                  </div><div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                </div>
              </div>
              <div class="row">
                <div class="mb-3 col-md-6 form-password-toggle fv-plugins-icon-container">
                  <label class="form-label" for="newPassword">{{__('site.new password')}}</label>
                  <div class="input-group input-group-merge has-validation">
                    <input class="form-control" type="password" id="newPassword" name="password" placeholder="············">
                    <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                  </div><div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                </div>

                <div class="mb-3 col-md-6 form-password-toggle fv-plugins-icon-container">
                  <label class="form-label" for="confirmPassword">{{__('site.confirm new password')}}</label>
                  <div class="input-group input-group-merge has-validation">
                    <input class="form-control" type="password" name="password_confirmation" id="confirmPassword" placeholder="············">
                    <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                  </div><div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                </div>
                <div class="col-12 mb-4">
                  <h6>: {{__('site.password requirements')}}</h6>
                  <ul class="ps-3 mb-0">
                    <li class="mb-1">{{__('site.passMin')}}</li>
                    <li class="mb-1">{{__('site.passlow')}}</li>
                    <li>{{__('site.passsymbol')}}</li>
                  </ul>
                </div>
                <div>
                  <button type="submit" class="btn btn-primary me-2 waves-effect waves-light">{{__('site.savechanges')}}</button>
                  <button type="reset" class="btn btn-label-secondary waves-effect">{{__('site.cancel')}}</button>
                </div>
              </div>
            <input type="hidden"></form>
          </div>
        </div>
        <!--/ Change Password -->
      </div>
    </div>

  </div>

@endsection
