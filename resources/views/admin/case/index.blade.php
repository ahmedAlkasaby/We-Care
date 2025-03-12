@extends('admin.master')

@section('html')
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}"class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default"data-assets-path="../admin/assets/" data-template="vertical-menu-template">
@endsection

@section('title')
@lang('site.case') - @lang('site.charity')
@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<link rel="stylesheet" href={{ url('css/toastr.css') }}>
@endsection

@section('content')

<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <div class="container-fluid flex-grow-1 container-p-y">
           @include('admin.case.includes.static')
            @include('admin.includes.success')
            @include('admin.includes.displayErrors')
            <div class="card">
                <div class="table-responsive ">
                    @include('admin.includes.header_of_table',['model'=>'cases','filter'=>true ,'entity' => 'cases'])

                    @include('admin.case.includes.filter')
                    <div id="table-filter">
                        @include('admin.case.includes.table')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="{{ url('js/ajaxSetup.js') }}"></script>


{{-- <script src={{ url('js/filterAjaxInCase.js') }}></script> --}}
{{-- <script src={{ url('js/archiveAjaxInCase.js') }}></script> --}}
<script src={{ url('js/activeAjaxInCase.js') }}></script>
{{-- <script src={{ url('js/removeFromArchive.js') }}></script> --}}
{{-- <script src={{ url('js/recycleAhaxInCase.js') }}></script> --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        $(document).ready(function () {
            $('.form-select').select2({
                    dropdownParent: $('#casesFilter') // Targets the form where select2 is applied
            });
        });
    });
</script>

<script src={{ url("js/createTransfer.js") }}></script>
<script src={{ url("js/flashMessage.js")}}></script>

{{-- <script src={{ url("js/transferAjaxStoreInCase.js")}}></script> --}}
@endsection
