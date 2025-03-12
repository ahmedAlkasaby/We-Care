@extends('admin.master')

@section('html')
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}"
    class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" data-theme="theme-default"
    data-assets-path="../../admin/assets/" data-template="vertical-menu-template">
@endsection

@section('title')
@lang('site.messages') - @lang('site.charity')
@endsection

@section('content')
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
<div class="container-fluid flex-grow-1 container-p-y">
    @include('admin.includes.success')
    @include('admin.includes.displayErrors')
    <div class="card mb-4">
        <div class="card-header">
            <h3 class="card-title">@lang('site.message_details')</h3>
        </div>
        <div class="card-body">
            <table class="table table-md">
                <tbody>
                    <tr>
                        <th>@lang('site.name')</th>
                        <td>
                            {{$message->name}}
                        </td>
                    </tr>
                    <tr>
                        <th>@lang('site.email')</th>
                        <td>
                            {{$message->email}}
                        </td>
                    </tr>
                    <tr>
                        <th>@lang('site.phone')</th>
                        <td>
                            {{$message->phone}}
                        </td>
                    </tr>
                    <tr>
                        <th>@lang('site.body')</th>
                        <td>
                            {{$message->message}}
                        </td>
                    </tr>

                </tbody>
            </table>

        </div>
        <!-- </card body> -->
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">@lang('site.message_response')</h3>
        </div>
        <div class="card-body p-0">
            @if(auth()->user()->hasPermission('messages.update'))
            <form method="POST" action="{{route('messages.sendMessage', ['id' => $message->id])}}" >
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label>@lang('site.title')</label>
                        <input type="text" class="form-control" name="title" >
                    </div>
                    <div class="form-group mt-3">
                        <label>@lang('site.body')</label>
                        <textarea rows="5" class="form-control" name="body" ></textarea>
                    </div>
                    <div class="mt-3">
                        <button class="btn btn-success">@lang('site.submit')</button>
                        <a href="{{url()->previous()}}" class="btn btn-primary">@lang('site.back')</a>
                    </div>
                </div>
            </form>
            @endif
        </div>
    </div>
</div>
    </div>
</div>

@endsection
@section('js')
<script src={{ url("js/flashMessage.js")}}></script>

@endsection
