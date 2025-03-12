

@extends('admin.master')


@section('title')
@lang('site.pages') - @lang('site.charity')
@endsection


@section('html')
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}"
    class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default"
    data-assets-path="../../admin/assets/" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    @endsection

    @section("css")
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/43.1.0/ckeditor5.css">

    <style>
    
        .invalid-feedback {
            display: block !important;
            color: #dc3545 !important;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
        .is-invalid {
            border-color: #dc3545 !important;
        }
        textarea {
            background-color: #000; /* خلفية سوداء */
            color: #fff; /* لون النص أبيض */
            border: 1px solid #ccc; /* لون الحد إن أردت */
        }   

        </style>
        
    
    @endsection
    @section('content')
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <div class="content-wrapper">
          <div class="container-fluid flex-grow-1 container-p-y">


{{ Form::open(['route' => 'pages.store', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'class' => 'needs-validation']) }}

<div class="app-ecommerce-impact">
    <div class="col-md mb-4 mb-md-0">
        <div class="card">
            @include('admin.includes.success')
            @include('admin.includes.displayErrors')
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        @include('admin.includes.form.text', ['label' => __('site.name en'), 'fieldName' => 'name_en', 'class' => 'form-control', 'place' => __('site.Enter name'),'required' => true])
                        @error('name_en')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        @include('admin.includes.form.text', ['label' => __('site.name ar'), 'fieldName' => 'name_ar', 'class' => 'form-control', 'place' => __('site.Enter name'),'required' => true])
                        @error('name_ar')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="main-container">
                    <label for="">@lang('site.Description en')</label>
                    <textarea name="description_en" id="editor_en" class="textarea-dark">
                        <p>{{ old('description_en') }}</p>
                    </textarea>
                    @error('name_ar')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="main-container">
                    <label for="">@lang('site.Description ar')</label>
                    <textarea name="description_ar" id="editor_ar">
                        <p>{{ old('description_ar') }}</p>
                    </textarea>
                </div>

                <br>
                <div class="col-md-6 mb-3">
                    @include('admin.includes.form.select', ['label' => __('site.active'), 'id' => 'activeSelect', 'fieldName' => 'active', 'options' => ['', __('site.active'), '0' => __('site.no'), '1' => __('site.yes')], 'class' => 'select2 form-select', 'required' => true])
                    @error('active')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="d-flex justify-content-end mb-3">
                    <button type="submit" class="btn btn-primary waves-effect waves-light me-2">{{ __("site.submit") }}</button>
                    <a href="{{ route('pages.index') }}" class="btn btn-secondary waves-effect waves-light">{{ __("site.Return to List") }}</a>
                </div>
            </div>
        </div>
    </div>
</div>

{!! Form::close() !!}
<!-- Form End -->
@endsection
@section('js')

<script type="importmap">
    {
        "imports": {
            "ckeditor5": "https://cdn.ckeditor.com/ckeditor5/43.1.0/ckeditor5.js",
            "ckeditor5/": "https://cdn.ckeditor.com/ckeditor5/43.1.0/"
        }
    }
</script>
<script type="module">
    import {
        ClassicEditor,
        Essentials,
        Paragraph,
        Bold,
        Italic,
        Font
    } from 'ckeditor5';
    ClassicEditor
        .create( document.querySelector( '#editor_ar' ), {
            plugins: [ Essentials, Paragraph, Bold, Italic, Font ],
            toolbar: [
                'undo', 'redo', '|', 'bold', 'italic', '|',
                'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor'
            ]
        } )
        .then( editor => {
            window.editor = editor;
        } )
        .catch( error => {
            console.error( error );
        } );
        ClassicEditor
        .create( document.querySelector( '#editor_en' ), {
            plugins: [ Essentials, Paragraph, Bold, Italic, Font ],
            toolbar: [
                'undo', 'redo', '|', 'bold', 'italic', '|',
                'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor'
            ]
        } )
        .then( editor => {
            window.editor = editor;
        } )
        .catch( error => {
            console.error( error );
        } );
</script>
<script>
    window.onload = function() {
        if ( window.location.protocol === 'file:' ) {
            alert( 'This sample requires an HTTP server. Please serve this file with a web server.' );
        }
    };
</script>
@endsection



