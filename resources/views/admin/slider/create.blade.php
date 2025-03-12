@extends('admin.master')

@section('title')
@lang('site.slider') - @lang('site.charity')
@endsection

@section('html')
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" data-theme="theme-default" data-assets-path="../../admin/assets/" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
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

                {{ Form::open(['route' => "sliders.store", 'method' => "POST", 'enctype' => "multipart/form-data", 'class' => "needs-validation"]) }}

                <div class="app-ecommerce-impact">
                    <div class="col-md mb-4 mb-md-0">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        @include('admin.includes.form.text', ['label' => __('site.name en'), 'fieldName' => 'name_en', 'class' => 'form-control', 'place' => __('site.Enter name')])
                                        @error('name_en')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        @include('admin.includes.form.text', ['label' => __('site.name ar'), 'fieldName' => 'name_ar', 'class' => 'form-control', 'place' => __('site.Enter name')])
                                        @error('name_ar')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    @include('admin.includes.form.textarea', ['label' => __('site.Description en'), 'fieldName' => 'description_en', 'place' => __('site.Add a Description'), 'rows' => 4, 'id' => 'description_en'])
                                    @error('description_en')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    @include('admin.includes.form.textarea', ['label' => __('site.Description ar'), 'fieldName' => 'description_ar', 'place' => __('site.Add a Description'), 'rows' => 4, 'id' => 'description_ar'])
                                    @error('description_ar')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        @include('admin.includes.form.select', ['label' => __('site.cases'), 'options' => $array, 'fieldName' => 'case_id', 'class' => 'select2 form-select'])
                                        @error('case_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        @include('admin.includes.form.select', ['label' => __('site.active'), 'id' => 'activeSelect', 'fieldName' => 'active', 'options' => [ '0' => __('site.no'), '1' => __('site.yes')], 'class' => 'select2 form-select', 'required' => false])
                                        @error('active')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">@lang('site.image')</label>
                                    <span class="note needsclick btn bg-label-primary d-inline" id="btnBrowse">@lang('site.image')</span>
                                    <input type="file" id="imageInput" name="image" style="display: none;" accept="image/*">
                                    <div id="imagePreview" style="margin-top: 20px;">
                                        <img id="previewImg" src="" alt="Image Preview" style="width: 50%; display: none;">
                                    </div>
                                    @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="d-flex justify-content-end mb-3">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light me-2">{{ __("site.submit") }}</button>
                                    <a href="{{ route('sliders.index') }}" class="btn btn-secondary waves-effect waves-light">{{ __("site.Return to List") }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script src={{ url("js/createImageSlider.js") }}></script>
@endsection
