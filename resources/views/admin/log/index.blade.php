@extends('admin.master')

@section('html')
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" data-theme="theme-default" data-assets-path="../admin/assets/" data-template="vertical-menu-template">
@endsection

@section('title')
@lang('site.logs') - @lang('site.charity')
@endsection

@section('content')
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <div class="container-fluid flex-grow-1 container-p-y">
            @include('admin.includes.success')
            @include('admin.includes.displayErrors')
        
            <div class="card">
                <div class="card-datatable table-responsive">
                    @include('admin.log.includes.search')
                    @include('admin.log.includes.table')

                    <div class="m-3">
                        {{ $logs->links() }}
                    </div>
                </div>
            </div>



        </div>
    </div>
</div>
@endsection

@section('js')


<script src={{ url("js/flashMessage.js")}}></script>

@endsection
