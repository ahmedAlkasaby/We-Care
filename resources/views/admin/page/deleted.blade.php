@extends('admin.master')

@section('html')
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}"
    class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" data-theme="theme-default"
    data-assets-path="../../admin/assets/" data-template="vertical-menu-template">
@endsection

@section('title')
@lang('site.pages') - @lang('site.charity')
@endsection

@section('content')

    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
          <div class="content-wrapper">
            <div class="container-fluid flex-grow-1 container-p-y">
                @include('admin.includes.success')
                @include('admin.includes.displayErrors')

                <div class="card">
                  <div class="card-datatable table-responsive">
                      @include('admin.page.includes.filter')
                    <table class="datatable table border-top">
                        <thead>
                            <tr>
                                <th>
                                    <div class="text-lg-center">ID</div>
                                </th>
                                <th class="text-lg-center">{{__("site.name")}}</th>
                                <th class="text-lg-center">{{__("site.action")}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($pages->isNotEmpty())
                            @foreach ($pages as $page)
                            <tr>
                                <td class="text-lg-center">{{$loop->iteration}}</td>
                                <td class="text-lg-center">{{ $page->nameLang() }}</td>


                                <td class="text-lg-center" style="text-align: center; vertical-align: middle;">
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="ti ti-dots-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <form action="{{ route('pages.restore', ['page' => $page->id]) }}" method="POST">
                                                @csrf
                                                @method("POST")
                                                @if (auth()->user()->hasPermission('pages.update'))
                                                <button type="submit" class="dropdown-item">
                                                    <i class="ti ti-pencil me-1"></i> @lang('site.restore')
                                                </button>
                                                @else
                                                <button type="submit" class="dropdown-item" disabled>
                                                    <i class="ti ti-pencil me-1"></i> @lang('site.restore')
                                                </button>
                                                @endif
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="7" class="text-center">@lang('site.there_is_no_data')</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                    <div class="m-2">
                        {{ $pages->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src={{ url("js/flashMessage.js")}}></script>

@endsection
