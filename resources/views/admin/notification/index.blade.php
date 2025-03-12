@extends('admin.master')

@section('html')
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}"
    class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" data-theme="theme-default"
    data-assets-path="../admin/assets/" data-template="vertical-menu-template">
@endsection

@section('title')
@lang('site.notification') - @lang('site.charity')
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
                    <table class="datatable table border-top">
                        <thead>
                            <tr>
                                <th>
                                    <div class="text-sm">ID</div>
                                </th>
                                <th class="text-lg-center">{{__("site.case")}}</th>
                                <th class="text-lg-center">{{__("site.descritption")}}</th>
                                <th class="text-lg-center">{{__("site.make_as_read")}}</th>
                            </tr>
                        </thead>
                        @if ($notifications->count() > 0)
                            <tbody>
                                @foreach ($notifications as $notification)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    @php
                                    $case_id=$notification->data['case_id'];
                                    $lang=app()->getLocale() ?? "ar";
                                   @endphp

                                <td class="text-lg-center">
                                    @if($case_id)
                                    <a href="{{ route('cases.show',['case'=>$case_id]) }}">
                                       {{  App\Models\CharityCase::find($case_id)->user->name ?? __("site.null") }}
                                    </a>
                                    @else
                                    @lang('site.charity')
                                    @endif
                                </td>
                                <td class="text-lg-center">
                                    {{ json_decode($notification->data['messages'])->$lang ?? __("site.null") }}
                                </td>

                                <td class="text-lg-center">
                                    <button class="btn btn-primary make-as-read"
                                            data-notification-id="{{ $notification->id }}">
                                        @lang('site.make_as_read')
                                    </button>
                                </td>



                                {{-- <tr onclick="event.preventDefault(); document.getElementById('mark-as-read-{{ $notification->id }}').submit();">
                                    <form id="mark-as-read-{{ $notification->id }}" action="{{ route('notifications.markAsRead', $notification->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('PATCH')
                                    </form>
                                </tr> --}}
                                @endforeach

                            </tbody>
                        @else
                            <tr>
                                <td colspan="7" class="text-center">@lang('site.there_is_no_data')</td>
                            </tr>
                        @endif
                    </table>
                    <div class="m-2">
                        {{ $notifications->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')

<script src={{ url("js/flashMessage.js")}}></script>

@include('admin.notification.includes.make_as_read')

@endsection

