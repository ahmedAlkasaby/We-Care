@extends("admin.master")
@section("html")
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == " ar" ? "rtl" : "ltr" }}"class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default"data-assets-path="../../admin/assets/" data-template="vertical-menu-template">
@endsection

@section("title")
@lang("site.cases") - @lang("site.charity")
@endsection

@section("css")

<link rel="stylesheet" href="{{ url("admin/assets/vendor/libs/typeahead-js/typeahead.css" )}}" />
<link rel="stylesheet" href="{{ url("admin/assets/vendor/libs/bs-stepper/bs-stepper.css")}}" />
<link rel="stylesheet" href="{{ url("admin/assets/vendor/libs/dropzone/dropzone.css")}}" />
<link rel="stylesheet" href="{{ url("admin/assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.css")}}" />
<link rel="stylesheet" href="{{ url("admin/assets/vendor/libs/@form-validation/form-validation.css") }}" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@endsection



@section("content")
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <div class="container-fluid flex-grow-1 container-p-y">
            <div id="wizard-validation" class="bs-stepper wizard-validation mt-2">
                @include('admin.case.includes.form.header')
                <div class="bs-stepper-content">
                    @include("admin.includes.displayErrors")
                {!! Form::open(['route' => "cases.store", 'method' => 'post', 'enctype' =>'multipart/form-data', 'id' => 'wizard-validation-form']) !!}

                    @include('admin.case.includes.form.acount_details')

                    @include('admin.case.includes.form.case_description')

                   @include('admin.case.includes.form.case_need')

                {!! Form::close() !!}
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@section("js")
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.min.js"></script>

<script src="{{ url("admin/assets/vendor/libs/@form-validation/popular.js") }}"></script>
<script src="{{ url("admin/assets/vendor/libs/@form-validation/bootstrap5.js") }}"></script>
<script src="{{ url("admin/assets/vendor/libs/@form-validation/auto-focus.js") }}"></script>

<script src="{{ url("admin/assets/vendor/libs/select2/select2.js")}}"></script>
<script src="{{ url("admin/assets/vendor/libs/bs-stepper/bs-stepper.js")}}"></script>
<script src="{{ url("admin/assets/js/form-wizard-validation.js") }}"></script>

<script src="{{ url("js/repeater.js") }}"></script>
<script src="{{ url("js/createCase.js") }}"></script>
@endsection
