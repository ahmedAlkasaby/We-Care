@extends('admin.master')

@section('html')
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}"
  class="light-style layout-navbar-fixed layout-menu-fixed layout-compact"
   data-theme="theme-default"
   data-assets-path="../admin/assets/"
   data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
@endsection

@section('title')
@lang('site.storage') - @lang('site.charity')
@endsection

@section('content')
<div class="layout-wrapper layout-content-navbar">
  <div class="layout-container">
      <div class="container-fluid flex-grow-1 container-p-y">
    <!-- Product List Widget -->


<div class="row">
  <div class="col-lg-3 col-sm-6 mb-4">
      <div class="card card-border-shadow-primary h-100">
          <div class="card-body">
              <div class="d-flex align-items-center mb-2">
                  <div class="avatar me-4">
                      <span class="avatar-initial rounded bg-label-primary">
                          <i class="ti ti-truck ti-28px"></i>
                      </span>
                  </div>
                  <h4 id="case-that-need-price-count" class="mb-0">{{$items->count()}}</h4>
              </div>
              <p class="mb-1">@lang('site.items')</p>
          </div>
      </div>
  </div>

  <div class="col-lg-3 col-sm-6 mb-4">
      <div class="card card-border-shadow-warning h-100">
          <div class="card-body">
              <div class="d-flex align-items-center mb-2">
                  <div class="avatar me-4">
                      <span class="avatar-initial rounded bg-label-warning">
                          <i class="ti ti-alert-triangle ti-28px"></i>
                      </span>
                  </div>
                  <h4 id="case-that-need-items-count" class="mb-0">{{$storage->price}} {{__('site.egp')}}</h4>
              </div>
              <p class="mb-1">@lang('site.money')</p>
          </div>
      </div>
  </div>

  <div class="col-lg-3 col-sm-6 mb-4">
      <div class="card card-border-shadow-danger h-100">
          <div class="card-body">
              <div class="d-flex align-items-center mb-2">
                  <div class="avatar me-4">
                      <span class="avatar-initial rounded bg-label-danger">
                          <i class="ti ti-git-fork ti-28px"></i>
                      </span>
                  </div>
                  <h4 id="total-price-for-case-that-need-items" class="mb-0">{{$cases_price_needed}} {{__('site.egp')}}</h4>
              </div>
              <p class="mb-1">@lang('site.money_for_cases')</p>
          </div>
      </div>
  </div>

  <div class="col-lg-3 col-sm-6 mb-4">
      <div class="card card-border-shadow-info h-100">
          <div class="card-body">
              <div class="d-flex align-items-center mb-2">
                  <div class="avatar me-4">
                      <span class="avatar-initial rounded bg-label-info">
                          <i class="ti ti-clock ti-28px"></i>
                      </span>
                  </div>
                  <h4 id="total-price-for-case-that-need-price" class="mb-0">{{$total_price_donation}} {{__('site.egp')}}</h4>
              </div>
              <p class="mb-1">@lang('site.donation')</p>
          </div>
      </div>
  </div>
</div>




    <!-- Product List Table -->
    <div class="card">
        <div class="card-datatable table-responsive">
          @include('admin.storage.filter')
            <table class="datatable table border-top">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>@lang('site.name')</th>
                        <th class="text-lg-center">@lang('site.amount')</th>
                        <th class="text-lg-center">@lang('site.price')</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!$items->isEmpty())
                        @foreach ($items as $item)
                            <tr class="{{ $loop->iteration % 2 == 0 ? 'even' : 'odd' }}">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nameLang() }}</td>
                                <td class="text-lg-center">{{ $item->amount }}</td>
                                <td class="text-lg-center">{{ $item->price }}</td>

                            </tr>
                            <!-- Modal for Deletion -->
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4" class="text-center">@lang('site.there_is_no_data')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
            <div class="m-3">

                {{ $items->links() }}
            </div>
        </div>
    </div>
  </div>
  </div>
</div>

@endsection
@section('js')
<script src={{ url("js/flashMessage.js")}}></script>
<script src="{{ url('admin/assets/js/modal-edit-user.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
