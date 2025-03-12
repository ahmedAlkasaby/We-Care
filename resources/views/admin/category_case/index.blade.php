@extends('admin.master')



@section('html')
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}"
    class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" data-theme="theme-default"
    data-assets-path="../admin/assets/" data-template="vertical-menu-template">
@endsection

@section('title')
@lang('site.categories') - @lang('site.charity')
@endsection

@section('content')
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <div class="container-fluid flex-grow-1 container-p-y">
            @include('admin.includes.success')
            @include('admin.includes.displayErrors')
            <div class="card">
                <div class="card-datatable table-responsive">
                    @include('admin.category_case.includes.filter')

                    @include('admin.category_case.includes.table')
                </div>
            </div>

            @include('admin.category_case.includes.form')
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ url("js/editCategoryCase.js")}}"></script>
<script src="{{ url("js/createCategoryCase.js")}}"></script>
{{-- <script src="{{ url("js/active/activeAjaxInCategoryCase.js")}}"></script> --}}
<script src={{ url("js/flashMessage.js")}}></script>


@include('admin.includes.modal.ajax',['formId'=>'category_cases','modelId'=>'categoriesCaseForm' ,
'route'=>'category_cases' , 'variable'=>'category_case'])
@endsection
