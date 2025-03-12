@extends('admin.master')

@section('html')
<html
lang="{{ app()->getLocale() }}"
dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}"
class="light-style layout-navbar-fixed layout-menu-fixed layout-compact"
data-theme="theme-default"
data-assets-path="../../../admin/assets/"
data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
@endsection

@section('title')
@lang('site.setting') - @lang('site.charity')
@endsection

@section('content')
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <div class="content-wrapper">
        <div class="container-fluid flex-grow-1 container-p-y">

        @include('admin.includes.success')
        @include('admin.includes.displayErrors')

        <!-- Form Start -->
        <div class="card-header">
          <h4 class="py-3 mb-2"><span class="text-muted fw-light"></span>{{__('site.settings')}}</h4>
        </div>


        {!! Form::open([
            'url' => isset($setting) ? url("dashboard/settings/$setting->id") : url("dashboard/settings"),
            'method' => isset($setting) ? 'PUT' : 'POST',
            'enctype' => 'multipart/form-data',
            'class' => 'needs-validation'
        ]) !!}
            @csrf
        
            <div class="d-flex justify-content mb-3">
                <button type="submit" class="btn btn-primary waves-effect waves-light me-2">{{ __('site.savechanges') }}</button>
            </div>
        
            <div class="app-ecommerce-product">
                <div class="row mb-4">
                    <!-- Left Column (Name and Titles) -->
                    <div class="col-md mb-4 mb-md-0">
                        <div class="card">
                            <h5 class="card-header">{{ __('site.settinginfo') }}</h5>
                            <div class="card-body">
                                <div class="mb-3">
                                    @include('admin.includes.form.text', [
                                        'label' => __('site.sitetitle'),
                                        'id' => 'site_title',
                                        'fieldName' => 'site_title',
                                        'fieldValue' => $setting->site_title ?? '',
                                        'placeholder' => __('site.enter') . ' ' . __('site.sitetitle')
                                    ])
                                </div>
        
                                <div class="mb-3">
                                    @include('admin.includes.form.text', [
                                        'label' => __('site.sitephone'),
                                        'id' => 'site_phone',
                                        'fieldName' => 'site_phone',
                                        'fieldValue' => $setting->site_phone ?? '',
                                        'placeholder' => __('site.enter') . ' ' . __('site.sitephone')
                                    ])
                                </div>
        
                                <div class="mb-3">
                                    @include('admin.includes.form.text', [
                                        'label' => __('site.siteemail'),
                                        'id' => 'site_email',
                                        'fieldName' => 'site_email',
                                        'fieldValue' => $setting->site_email ?? '',
                                        'placeholder' => __('site.enter') . ' ' . __('site.siteemail'),
                                        'type' => 'email'
                                    ])
                                </div>
        
                                <div class="mb-3">
                                    @include('admin.includes.form.select', [
                                        'label' => __('site.sitelanguage'),
                                        'fieldName' => 'site_language',
                                        'options' => [
                                            'en' => __('site.english'),
                                            'ar' => __('site.arabic')
                                        ],
                                        'selected' => $setting->site_language ?? 'en',
                                        'class' => 'select2 form-select'
                                    ])
                                </div>
        
                                <div class="mb-3">
                                    @include('admin.includes.form.textarea', [
                                        'label' => __('site.address'),
                                        'fieldName' => 'address',
                                        'fieldValue' => $setting->address ?? '',
                                        'rows' => 3,
                                        'id' => 'address'
                                    ])
                                </div>
                            </div>
                        </div>
                    </div>
        
                    <!-- Right Column (Additional Info) -->
                    <div class="col-md">
                        <div class="card">
                            <h5 class="card-header">{{ __('site.additionalinfo') }}</h5>
                            <div class="card-body">
                                <div class="mb-3">
                                    @include('admin.includes.form.text', [
                                        'label' => 'WhatsApp Number',
                                        'id' => 'whatsapp',
                                        'fieldName' => 'whatsapp',
                                        'fieldValue' => $setting->whatsapp ?? '',
                                        'placeholder' => 'Enter WhatsApp Number'
                                    ])
                                </div>
        
                                <div class="mb-3">
                                    @include('admin.includes.form.text', [
                                        'label' => 'FaceBook',
                                        'id' => 'facebook',
                                        'fieldName' => 'facebook',
                                        'fieldValue' => $setting->facebook ?? '',
                                        'placeholder' => 'Enter FaceBook Link'
                                    ])
                                </div>
        
                                <div class="mb-3">
                                    @include('admin.includes.form.text', [
                                        'label' => 'Twitter',
                                        'id' => 'twitter',
                                        'fieldName' => 'twitter',
                                        'fieldValue' => $setting->twitter ?? '',
                                        'placeholder' => 'Enter Twitter Link'
                                    ])
                                </div>
        
                                <div class="mb-3">
                                    @include('admin.includes.form.text', [
                                        'label' => 'Instagram',
                                        'id' => 'instagram',
                                        'fieldName' => 'instagram',
                                        'fieldValue' => $setting->instagram ?? '',
                                        'placeholder' => 'Enter Instagram Link'
                                    ])
                                </div>
        
                                <div class="mb-3">
                                    @include('admin.includes.form.text', [
                                        'label' => 'Gmail',
                                        'id' => 'gmail',
                                        'fieldName' => 'gmail',
                                        'fieldValue' => $setting->gmail ?? '',
                                        'placeholder' => 'Enter Gmail',
                                        'type' => 'email'
                                    ])
                                </div>
        
                                <div class="mb-3">
                                    @include('admin.includes.form.text', [
                                        'label' => 'LinkedIn',
                                        'id' => 'linkedin',
                                        'fieldName' => 'linkedin',
                                        'fieldValue' => $setting->linkedin ?? '',
                                        'placeholder' => 'Enter LinkedIn Link'
                                    ])
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        {!! Form::close() !!}
        
        <!-- Form End -->
      </div>
    </div>
  </div>
</div>

@endsection
@section('js')
<script src={{ url("js/flashMessage.js")}}></script>

@endsection


