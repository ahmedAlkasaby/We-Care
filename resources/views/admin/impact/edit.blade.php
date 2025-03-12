@extends('admin.master')

@section('title')
@lang('site.impact') - @lang('site.charity')
@endsection

@section('html')
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}"
    class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" data-theme="theme-default"
    data-assets-path="../../../admin/assets/" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
@endsection
@section("css")
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
    </style>

@endsection
@section('content')
<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
  <div class="layout-container">
    <div class="content-wrapper">
      <div class="container-fluid flex-grow-1 container-p-y">@include('admin.includes.success') @include('admin.includes.displayErrors')

{{ Form::open(['route' => ["impacts.update", $impact->id], 'method' => "PUT", 'enctype' => "multipart/form-data", 'class' => "needs-validation"]) }}

<div class="app-ecommerce-impact">
    <div class="col-md mb-4 mb-md-0">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        @include('admin.includes.form.text', ['label' => __('site.name en'), 'id' => $name_en_id ?? null, 'fieldName' => 'name_en', 'fieldValue' => $name_en ?? null, 'class' => 'form-control', 'place' => __('site.Enter name'), 'required' => true])
                        @error('name_en')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        @include('admin.includes.form.text', ['label' => __('site.name ar'), 'id' => $name_ar_id ?? null, 'fieldName' => 'name_ar', 'fieldValue' => $name_ar ?? null, 'class' => 'form-control', 'place' => __('site.Enter name'), 'required' => true])
                        @error('name_ar')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    @include('admin.includes.form.textarea', ['label' => __('site.Description en'), 'id' => $description_en_id ?? 'edit-form-desc-en', 'fieldName' => 'description_en', 'fieldValue' => $description_en ?? null, 'place' => __('site.Add a Description'), 'rows' => 4, 'required' => true])
                    @error('description_en')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="mb-3">
                    @include('admin.includes.form.textarea', ['label' => __('site.Description ar'), 'id' => $description_ar_id ?? 'edit-form-desc-ar', 'fieldName' => 'description_ar', 'fieldValue' => $description_ar ?? null, 'place' => __('site.Add a Description'), 'rows' => 4, 'required' => true])
                    @error('description_ar')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        @include('admin.includes.form.select', ['label' => __('site.cases'), 'options' => $caseArr, 'fieldName' => 'case_id', 'fieldValue' => $case_id ?? null, 'class' => 'select2 form-select', 'required' => true])
                        @error('case_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        @include('admin.includes.form.select', ['label' => __('site.active'), 'id' => 'activeSelect', 'fieldName' => 'active', 'options' => [ '0' => __('site.no'), '1' => __('site.yes')], 'fieldValue' => $impact->active, 'class' => 'select2 form-select', 'required' => true])
                        @error('active')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="images" class="form-label">@lang('site.upload_images')</label>
                    <input type="file" class="form-control" id="images" name="images[]" multiple accept="image/*" >
                    @error('images')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel" style="max-width: 400px; margin: 0 auto;">
                        <div class="carousel-inner">
                            @foreach ($impact->images as $image)
                            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                <img src="{{ asset('../uploads/' . $image->image) }}" class="d-block w-100 rounded img-fluid" alt="Image {{ $loop->index }}">
                            </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>

                <div class="d-flex justify-content-end mb-3">
                    <button type="submit" class="btn btn-primary waves-effect waves-light me-2">{{ __("site.submit") }}</button>
                    <a href="{{ route('impacts.index') }}" class="btn btn-secondary waves-effect waves-light">{{ __("site.Return to List") }}</a>
                </div>

                {!! Form::close() !!}
                <!-- Form End -->
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    // Handle image browsing and preview
    document.getElementById('btnBrowse').addEventListener('click', function() {
        document.getElementById('imageInput').click();
    });

    document.getElementById('imageInput').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const previewImg = document.getElementById('previewImg');
                previewImg.src = e.target.result;
                previewImg.style.display = 'block';
            }
            reader.readAsDataURL(file);
        }
    });
</script>
<script src="{{ url('js/flashMessage.js') }}"></script>
@endsection
