@extends('admin.master')

@section('html')
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" data-theme="theme-default" data-assets-path="../admin/assets/" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
@endsection

@section('title')
@lang('site.slider') - @lang('site.charity')
@endsection

@section('content')
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <div class="container-fluid flex-grow-1 container-p-y">
            @include('admin.includes.success')
            @include('admin.includes.displayErrors')

            <div class="card">
                <div class="card-datatable table-responsive">
                    @include('admin.slider.includes.filter')

                    @include('admin.slider.includes.table')
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
@section('js')
<script src={{ url("js/flashMessage.js")}}></script>
{{-- <script src="{{ url("js/active/activeAjaxInSlider.js")}}"></script> --}}
@endsection


