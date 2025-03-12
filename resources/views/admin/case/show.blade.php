@extends('admin.master')

@section('html')
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}"class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" data-theme="theme-default" data-assets-path="../../admin/assets/" data-template="vertical-menu-template">
@endsection

@section("css")
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
<style>
    .swiper-slide img {
        max-width: 100%;
        height: auto;
        display: block;
        margin: auto;

    }
    </style>
@endsection

@section('title')
@lang('site.case') - @lang('site.charity')
@endsection

@section('content')
<div class="layout-wrapper layout-content-navbar">
    <div class="container-fluid flex-grow-1 container-p-y">
        @include('admin.includes.success')
        @include('admin.includes.displayErrors')
        <div class="row">

            @include('admin.case.includes.caseUserSidebar')


            <!-- User Content -->
            <div class="col-xl-8 col-lg-7 order-0 order-md-1">
                <!-- User Pills -->
                <div class="nav-align-top">
                    <ul class="nav nav-pills flex-column flex-md-row flex-wrap mb-6 row-gap-2">
                        <li class="nav-item">
                            <a class="nav-link waves-effect waves-light active" href="#account" data-bs-toggle="tab">
                                <i class="ti ti-user-check ti-sm me-1_5"></i>@lang("site.account")
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link waves-effect waves-light" href="#details" data-bs-toggle="tab">
                                <i class="ti ti-lock ti-sm me-1_5"></i>@lang("site.Details")
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="account">
                        @include('admin.case.includes.static_in_show')
                    </div>
                    <div class="tab-pane fade" id="details">
                        @include('admin.case.details')
                    </div>
                </div>
            </div>

            <!--/ User Content -->
        </div>
        @if ($case->images->count() > 0)

        <div class="image-gallery" id="imageGallery">
            <div class="preview-box"
                 style="
                     cursor: pointer;
                     border: 2px solid #007bff;
                     padding: 15px;
                     display: inline-block;
                     max-width: 200px;
                     text-align: center;
                     background: #f8f9fa;
                     border-radius: 15px;
                     box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                     transition: transform 0.3s, box-shadow 0.3s;">
                <img src="{{ asset( $case->images->first()->image) }}"
                     class="img-fluid"
                     alt="@lang('site.preview')"
                     style="max-width: 100%; border-radius: 10px;">
                <p style="margin-top: 10px; font-weight: bold; color: #007bff;">@lang('site.view_all_images')</p>
            </div>
        </div>
        <br>
        @endif

        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title m-0">@lang('site.donation_details')</h5>
                @include('admin.donation.includes.search')
            </div>
            <div class="card-datatable table-responsive">
              @include('admin.donation.includes.table',['donation'=>$donations])
            </div>
            @include('admin.donation.create')

                  </div>

        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title m-0">@lang('site.transfer_details')</h5>
            </div>
            <div class="card-datatable table-responsive">
                @include('admin.transfer.includes.table',['transfers'=>$transfers])
            </div>
        </div>
    </div>
    </div>
    </div>


    <div id="imageSliderModal" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <!-- Swiper Slider -->
                    <div class="swiper">
                        <div class="swiper-wrapper">
                            @foreach ($case->images as $image)
                            <div class="swiper-slide">
                                <img src="{{ asset( $image->image) }}" class="img-fluid" alt="@lang('site.image') {{ $loop->iteration }}" />
                            </div>
                            @endforeach
                        </div>
                        <!-- Navigation -->
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('js')
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- jQuery Repeater -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

{{-- <script src={{ url("admin/assets/vendor/libs/select2/select2.js")}}></script> --}}

<script src={{ url("js/createDonationByCase.js")}}></script>
<script src={{ url("js/repeaterDonation.js")}}></script>
<script src={{ url("js/flashMessage.js")}}></script>
<script src="{{ url("js/createTransferByDonation.js") }}"></script>
<script src={{ url("js/createTransfer.js") }}></script>

<script src={{ url("js/confirm_donation.js") }}></script>
<script src={{ url("js/repeaterConfirm.js") }}></script>
<script src={{ url("js/confirm_donation-price.js") }}></script>
<script>
    document.getElementById('imageGallery').addEventListener('click', function () {
        var modal = new bootstrap.Modal(document.getElementById('imageSliderModal'));
        modal.show();
    });

    const swiper = new Swiper('.swiper', {
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        loop: true,
    });
    </script>

@endsection
