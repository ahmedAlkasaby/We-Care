@extends('admin.master')

@section('html')
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}"
    class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" data-theme="theme-default"
    data-assets-path="../admin/assets/" data-template="vertical-menu-template">

@endsection

@section('title')
@lang('site.items') - @lang('site.charity')
@endsection

@section('content')
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <div class="container-fluid flex-grow-1 container-p-y">
            @include('admin.includes.success')
            @include('admin.includes.displayErrors')
            <div class="card">
                <div class="card-datatable table-responsive">
                    @include('admin.includes.header_of_table',['model'=>'items','filter'=>false,'entity'=>'item'])
                    @include('admin.item.includes.table')
                </div>
            </div>

            @include('admin.item.includes.form')

        </div>
    </div>
</div>
@endsection

@section('js')

<script src="{{ url('js/ajaxSetup.js') }}"></script>
<script src={{ url("js/editItem.js")}}></script>
<script src={{ url("js/createItem.js")}}></script>
<script src={{ url("js/flashMessage.js")}}></script>
@include('admin.includes.modal.ajax',['formId'=>'items','modelId'=>'itemsForm' , 'route'=>'items' , 'variable'=>'item'])
@endsection
