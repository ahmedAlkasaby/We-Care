@extends('admin.master')

@section('html')
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}"
  class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" data-theme="theme-default"
  data-assets-path="../../admin/assets/" data-template="vertical-menu-template">

<head>
  <meta charset="utf-8" />
  <meta name="viewport"
    content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  @endsection
  @section("css")
  <link rel="stylesheet" href="{{asset(" admin/assets/vendor/css/pages/page-user-view.css")}}">
  @endsection
  @section('title')
  @lang('site.doners') - @lang('site.charity')
  @endsection

  @section('content')
  <div class="layout-wrapper layout-content-navbar">
    <div class="container-fluid flex-grow-1 container-p-y">
      @include('admin.includes.success')
      @include('admin.includes.displayErrors')
      <div class="row">
        <!-- User Sidebar -->
        <div class="col-xl-4 col-lg-5 order-1 order-md-0">
          <!-- User Card -->
          @include('admin.doner.includes.doner_info')
          <!-- /User Card -->
        </div>
        <!--/ User Sidebar -->


        <!-- User Content -->
        @include('admin.doner.includes.doner_items')
        
        <!--/ User Content -->
      </div>
      <br>
      <div class="card mb-6">
        <div class="card-datatable table-responsive">
          @include('admin.donation.includes.table',['donation'=>$doner->donations])
          <div class="m-3">
              {{ $donations->links() }}
          </div>
      </div>
      </div>
    </div>
  </div>
  </div>
  @include('admin.doner.includes.form',["page"=>true])
  @endsection
  @section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.min.js"></script>
<script src={{ url("admin/assets/vendor/libs/select2/select2.js")}}></script>
<script src={{ url('js/repeaterDonation.js') }}></script>
<script src={{ url('js/createDonationByCase.js')}}></script>
<script src={{ url("js/flashMessage.js")}}></script>
<script src={{ url("js/confirm_donation.js") }}></script>
<script src={{ url("js/confirm_donation-price.js") }}></script>
<script src="{{ url("js/createTransferByDonation.js") }}"></script>

@endsection