@extends('admin.master')

@section('html')
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" data-theme="theme-default" data-assets-path="../admin/assets/" data-template="vertical-menu-template">
@endsection

@section('title')
@lang('site.purchases') - @lang('site.charity')
@endsection

@section('content')
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <div class="container-fluid flex-grow-1 container-p-y">
            @include('admin.includes.success')
            @include('admin.includes.displayErrors')
            @include('admin.purchase.includes.static')
            <div class="card">
                <div class="card-datatable table-responsive">
                    @include('admin.purchase.includes.search')
                    @include('admin.purchase.includes.table')
                    
                    <div class="m-3">
                        {{ $purchases->links() }}
                    </div>
                </div>
            </div>

            @include('admin.purchase.create')

        </div>
    </div>
</div>
@endsection

@section('js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.min.js"></script>
@include('admin.purchase.includes.scriptEditPurchase')
{{-- @include('admin.purchase.includes.scriptCreatePurchase') --}}
<script src={{ url("js/flashMessage.js")}}></script>

@endsection