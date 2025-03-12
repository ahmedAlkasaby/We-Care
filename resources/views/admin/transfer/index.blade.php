@extends('admin.master')


@section('title')
@lang('site.transfer') - @lang('site.charity')
@endsection



@section('html')
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}"
    class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default"
    data-assets-path="../admin/assets/" data-template="vertical-menu-template">
@endsection



@section('content')

<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <div class="container-fluid flex-grow-1 container-p-y">
            @include('admin.transfer.includes.static')
            @include('admin.includes.success')
            <div class="card">

               @include('admin.transfer.includes.table',['transfers'=>$transfers])

            </div>
        </div>
    </div>
</div>
@endsection
@section('js')

<script src={{ url("js/flashMessage.js")}}></script>
@endsection
