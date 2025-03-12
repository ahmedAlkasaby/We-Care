@extends('admin.master')


@section('title')
@lang('site.faqs') - @lang('site.charity')
@endsection


@section('html')
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}"
    class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default"
    data-assets-path="../../admin/assets/" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    @endsection

    @section("css")
    <style>
    
        .invalid-feedback {
            display: block !important;
            color: #dc3545 !important;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
        .is-invalid {
            border-color: #dc3545 !important;
        }
        </style>
    
    @endsection
    @section('content')
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <div class="content-wrapper">
          <div class="container-fluid flex-grow-1 container-p-y">


{{ Form::open(['route' => 'faqs.store', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'class' => 'needs-validation']) }}

<div class="app-ecommerce-faq">
    <div class="col-md mb-4 mb-md-0">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        @include('admin.includes.form.text', ['label' => __('site.name en'), 'fieldName' => 'name_en', 'class' => 'form-control', 'place' => __('site.Enter name'),'required' => true])
                        @error('name_en')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        @include('admin.includes.form.text', ['label' => __('site.name ar'), 'fieldName' => 'name_ar', 'class' => 'form-control', 'place' => __('site.Enter name'),'required' => true])
                        @error('name_ar')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    @include('admin.includes.form.textarea', ['label' => __('site.Description en'), 'fieldName' => 'description_en', 'place' => __('site.Add a Description'), 'rows' => 4])
                    @error('description_en')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="mb-3">
                    @include('admin.includes.form.textarea', ['label' => __('site.Description ar'), 'fieldName' => 'description_ar', 'place' => __('site.Add a Description'), 'rows' => 4])
                    @error('description_ar')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>


                    <div class="col-md-6 mb-3">
                        @include('admin.includes.form.select', ['label' => __('site.active'), 'id' => 'activeSelect', 'fieldName' => 'active', 'options' => ['', __('site.active'), '0' => __('site.no'), '1' => __('site.yes')], 'class' => 'select2 form-select', 'required' => true])
                        @error('active')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                <div class="d-flex justify-content-end mb-3">
                    <button type="submit" class="btn btn-primary waves-effect waves-light me-2">{{ __("site.submit") }}</button>
                    <a href="{{ route('faqs.index') }}" class="btn btn-secondary waves-effect waves-light">{{ __("site.Return to List") }}</a>
                </div>
            </div>
        </div>
    </div>
</div>

{!! Form::close() !!}
<!-- Form End -->
@endsection


