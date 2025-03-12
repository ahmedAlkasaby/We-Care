@extends('admin.master')

@section('html')
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}"
    class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" data-theme="theme-default"
    data-assets-path="../admin/assets/" data-template="vertical-menu-template">
@endsection

@section('title')
@lang('site.messages') - @lang('site.charity')
@endsection

@section('content')
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
<div class="container-fluid flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-header">
            <h4 class="py-1 mb-1">
                @lang('site.messages')
            </h4>
        </div>

        <div class="card-datatable table-responsive">
            <table class="table table-md">

                <thead class="border-top">
                    <tr>
                        <th>ID</th>
                        <th>@lang('site.name')</th>
                        <th>@lang('site.phone')</th>
                        <th>@lang('site.email')</th>
                        <th class="text-center">@lang('site.actions')</th>
                    </tr>
                </thead>
                @if ($messages->count() > 0)
                    <tbody>
                        @foreach ($messages as $message)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{ $message->name }}</td>
                            <td>{{ $message->phone }}</td>
                            <td>{{ $message->email }}</td>

                            <td>
                                @if(auth()->user()->hasPermission('messages.index'))
                               @if ($message->read == 0)
                                    <div class="text-center">
                                        <a href="{{url("dashboard/messages/$message->id")}}" class="btn btn-sm btn-info">
                                            <i class="fa-solid fa-envelope"></i>
                                        </a>
                                    </div>
                                @else
                                    <div class="text-center">
                                        <a href="{{url("dashboard/messages/$message->id")}}" class="btn btn-sm btn-info">
                                            <i class="fa-solid fa-envelope-open"></i>
                                        </a>
                                    </div>
                                @endif
                                @else
                                @if ($message->read == 0)
                                <div class="text-center">
                                    <a href="{{url("dashboard/messages/$message->id")}}" class="btn btn-sm btn-info" disabled>
                                        <i class="fa-solid fa-envelope"></i>
                                    </a>
                                </div>
                            @else
                                <div class="text-center">
                                    <a href="{{url("dashboard/messages/$message->id")}}" class="btn btn-sm btn-info" disabled>
                                        <i class="fa-solid fa-envelope-open"></i>
                                    </a>
                                </div>
                            @endif
                                @endif
                            </td>
                        </tr>
                        @endforeach
                        {{ $messages->links() }}
                    </tbody>

                @else
                    <tr>
                        <td colspan="7" class="text-center">@lang('site.there_is_no_data')</td>
                    </tr>
                @endif
            </table>
        </div>
    </div>
</div>
    </div>
</div>

@endsection
@section('js')
<script src={{ url("js/flashMessage.js")}}></script>

@endsection
