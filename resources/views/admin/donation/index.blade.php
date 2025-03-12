@extends('admin.master')

@section('html')
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}"
    class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" data-theme="theme-default"
    data-assets-path="../admin/assets/" data-template="vertical-menu-template">
@endsection

@section('title')
@lang('site.donations') - @lang('site.charity')
@endsection

@section('css')
<link rel="stylesheet" href={{ url("admin/assets/vendor/libs/typeahead-js/typeahead.css" )}} />
<link rel="stylesheet" href={{ url("admin/assets/vendor/libs/dropzone/dropzone.css")}} />
<link rel="stylesheet" href={{ url("admin/assets/vendor/libs/bs-stepper/bs-stepper.css")}} />
<link rel="stylesheet" href={{ url("admin/assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.css")}} />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <div class="container-fluid flex-grow-1 container-p-y">
            @include('admin.donation.includes.static')
            @include('admin.includes.success')
            @include('admin.includes.displayErrors')
            <div class="card">
                <div class="card-datatable table-responsive">
                    @include('admin.donation.includes.search')
                    @include('admin.donation.includes.filter')
                    @include('admin.donation.includes.table',['donation'=>$donations])
                    <div class="m-3">
                        {{ $donations->links() }}
                    </div>
                </div>
            </div>
            @include('admin.donation.create')
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.min.js"></script>
<script src={{ url("admin/assets/vendor/libs/select2/select2.js")}}></script>
<script src={{ url('js/repeaterDonation.js') }}></script>
<script src={{ url('js/createDonationByCase.js')}}></script>
<script src={{ url("js/flashMessage.js")}}></script>
<script src="{{ url("js/createTransferByDonation.js") }}"></script>


<script src={{ url("js/confirm_donation-price.js") }}></script>
@endsection
