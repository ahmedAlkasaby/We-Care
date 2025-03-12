@extends('admin.master')

@section('html')
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}"
    class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" data-theme="theme-default"
    data-assets-path="../admin/assets/" data-template="vertical-menu-template">
@endsection

@section('title')
@lang('site.regions') - @lang('site.charity')
@endsection

@section('content')
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <div class="container-fluid flex-grow-1 container-p-y">
            @include('admin.includes.success')
            @include('admin.includes.displayErrors')
            <div class="card">
                @include('admin.region.includes.table')
            </div>

            @include('admin.region.includes.form')
        </div>
    </div>
</div>
@endsection
@section('js')
<script src={{ url("admin/assets/vendor/libs/select2/select2.js")}}></script>
<script src="{{ url('admin/assets/js/modal-edit-user.js') }}"></script>

<script src="{{ url('js/ajaxSetup.js') }}"></script>
<script src={{ url('js/editRegion.js') }}></script>
<script src={{ url('js/createRegion.js') }}></script>
<script src={{ url("js/flashMessage.js")}}></script>
@include('admin.includes.modal.ajax',['formId'=>'regions','modelId'=>'regionsForm' , 'route'=>'regions' ,
'variable'=>'region'])
@endsection