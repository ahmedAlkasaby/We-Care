@extends('admin.master')


@section('title')
@lang('site.transfer') - @lang('site.charity')
@endsection



@section('html')
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}"
  class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default"
  data-assets-path="../../admin/assets/" data-template="vertical-menu-template">
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/app-invoice.css') }}" />

@endsection


@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="row invoice-preview">
    <!-- Invoice -->
    <div class="col-xl-9 col-md-8 col-12 mb-md-0 mb-4">
      <div class="card invoice-preview-card">
        <div class="card-body">
          <div class="d-flex justify-content-between flex-xl-row flex-md-column flex-sm-row flex-column m-sm-3 m-0">
            <div class="mb-xl-0 mb-4">
              <div class="d-flex svg-illustration mb-4 gap-2 align-items-center">
                <div class="app-brand-logo demo">
                  <svg width="32" height="22" viewBox="0 0 32 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                      d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z"
                      fill="#7367F0"></path>
                    <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd"
                      d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z" fill="#161616"></path>
                    <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd"
                      d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z" fill="#161616"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd"
                      d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z"
                      fill="#7367F0"></path>
                  </svg>
                </div>
                <span class="app-brand-text fw-bold fs-4"> @lang('site.Woudyan') </span>
              </div>
              {{-- <p class="mb-2">Office 149, 450 South Brand Brooklyn</p>
              <p class="mb-2">San Diego County, CA 91905, USA</p>
              <p class="mb-0">+1 (123) 456 7891, +44 (876) 543 2198</p> --}}
            </div>
            <div>
              <h4 class="fw-medium mb-2">{{__('site.transefer')}} #{{$transfer->id}}</h4>
              <div class="mb-2 pt-1">
                <span>{{__('site.Date')}}:</span>
                <span class="fw-medium">{{$transfer->created_at}}</span>
              </div>

            </div>
          </div>
        </div>
        <hr class="my-0">
        <div class="card-body">
          <div class="row p-sm-3 p-0">
            <div class="col-xl-6 col-md-12 col-sm-5 col-12 mb-xl-0 mb-md-4 mb-sm-0 mb-4">
              <h6 class="mb-3">{{__('site.transfer to')}}:</h6>
              <p class="mb-1"><strong>@lang('site.name')</strong> : {{$case->user->name}}</p>
              {{-- <p class="mb-1">Shelby Company Limited</p> --}}
              <p class="mb-1"><strong>@lang('site.address')</strong> : {{$city->nameLang()}} : {{$region->nameLang()}}</p>
              <p class="mb-1"><strong>@lang('site.phone')</strong>{{$case->user->phone}}</p>
              <p class="mb-0"><strong>@lang('site.email')</strong>{{$case->user->email}}</p>
            </div>
            <div class="col-xl-6 col-md-12 col-sm-5 col-12 mb-xl-0 mb-md-4 mb-sm-0 mb-4">
              <h6 class="mb-3">{{__('site.information')}}:</h6>
              <table>
                <tbody>
                  <tr>
                    <td class="pe-4">{{__('site.total')}}:</td>
                    <td class="fw-medium">${{$transfer->get_price()}}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="table-responsive border-top">
          @if(count($transfer->items) > 0)
          <table class="table m-0">
            <thead class="align-top px-4 py-4">
              <tr>
                <th>{{__('site.item')}}</th>
                <th>{{__('site.price')}}</th>
                <th>{{__('site.qty')}}</th>
                <th>{{__('site.price')}}</th>
              </tr>
            </thead>
            <tbody>
              @foreach($transfer->items as $item)
              <tr>
                <td class="text-nowrap">{{$item->nameLang()}}</td>
                <td>${{$item->price}}</td>
                <td> {{$item->pivot->amount}}</td>
                <td>${{$item->price * $item->pivot->amount}}</td>
              </tr>
              @endforeach

              <tr>
                <td colspan="2">
                  {{-- <p class="mb-2 mt-3">
                    <span class="ms-3 fw-medium">Salesperson:</span>
                    <span>Alfie Solomons</span>
                  </p>
                  <span class="ms-3">Thanks for your business</span> --}}
                </td>
                <td class="text-end ps-2 py-4">
                  <p class="mb-0 pb-3">@lang('site.total'):</p>
                </td>
                <td class="ps-2 py-4">
                  <p class="fw-medium mb-0 pb-3">${{ $transfer->get_price() }}</p>
                </td>
              </tr>
            </tbody>
          </table>
          @else

          @endif
        </div>

        {{-- <div class="card-body mx-3">
          <div class="row">
            <div class="col-12">
              <span class="fw-medium">Note:</span>
              <span>It was a pleasure working with you and your team. We hope you will keep us in mind for
                future freelance projects. Thank You!</span>
            </div>
          </div>
        </div> --}}
      </div>
    </div>
    <!-- /Invoice -->

    <!-- Invoice Actions -->
    <div class="col-xl-3 col-md-4 col-12 invoice-actions">
      <div class="card">
        <div class="card-body">
          {{-- <a href="#" class="btn btn-primary d-grid w-100 mb-2 waves-effect waves-light">Download</a> --}}
          <a href="javascript:window.print()" class="btn btn-primary d-grid w-100 mb-2 waves-effect waves-light">Print</a>
        </div>
      </div>
    </div>
    <!-- /Invoice Actions -->
  </div>
</div>

@endsection