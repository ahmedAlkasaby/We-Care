@extends('admin.master')

@section('html')
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}"
    class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" data-theme="theme-default"
    data-assets-path="../../admin/assets/" data-template="vertical-menu-template">
@endsection

@section('title')
@lang('site.donations') - @lang('site.charity')
@endsection
@section('css')
<link rel="stylesheet" href={{ url("admin/assets/vendor/libs/typeahead-js/typeahead.css" )}} />
<link rel="stylesheet" href={{ url("admin/assets/vendor/libs/dropzone/dropzone.css")}} />
<link rel="stylesheet" href={{ url("admin/assets/vendor/libs/bs-stepper/bs-stepper.css")}} />
<link rel="stylesheet" href={{ url("admin/assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.css")}} />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
@include('admin.includes.displayErrors')
@include('admin.includes.success')

<div class="container-xxl flex-grow-1 container-p-y">

    <div
        class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 row-gap-4">
        <div class="d-flex flex-column justify-content-center">
            <div class="mb-1">
                <span class="h5">{{ __('site.donation') }} {{$donation->id}}</span>
                @if ($donation->confirm == 1)
                <span class="badge bg-label-success">@lang('site.confirmed')</span>
                @else
                <span class="badge bg-label-danger">@lang('site.not confirmed')</span>
                @endif
            </div>
            <p class="mb-0">{{$donation->created_at}}</p>
        </div>
        <div class="d-flex align-content-center flex-wrap gap-2">
            @if ($donation->confirm == 0)
            @if(auth()->user()->hasPermission('donations.destroy'))
            <button class="btn btn-label-danger delete-order waves-effect" data-bs-toggle="modal"
                data-bs-target="#deleteModal{{ $donation->id }}">
                <i class="ti ti-trash me-1"></i> @lang('site.delete')
            </button>
            @else
            <button class="btn btn-label-danger delete-order waves-effect" disabled>
                <i class="ti ti-trash me-1"></i> @lang('site.no_permission')
            </button>
            @endif
            @else
            <button class="btn btn-label-danger delete-order waves-effect" disabled>
                <i class="ti ti-trash me-1"></i> @lang('site.delete')
            </button>
            @endif

        </div>
    </div>

    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="card mb-6">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title m-0">@lang('site.details')</h5>
                </div>

                @if ($donation->confirm == 0)
                <div class="mb-3">
                    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel" style="max-width: 400px; margin: 0 auto;">
                        <style>
                            .carousel-image-wrapper {
                                width: 100%;
                                height: 300px; /* يمكنك تغيير الارتفاع حسب احتياجك */
                                overflow: hidden;
                                border-radius: 10px; /* اختياري لإضافة حواف مستديرة */
                                position: relative;
                            }

                            .carousel-image-wrapper img {
                                width: 100%;
                                height: 100%;
                                object-fit: cover; /* يجعل الصورة تملأ المساحة دون تشويه */
                                cursor: pointer; /* يجعل الصورة قابلة للضغط */
                            }

                            .carousel-control-prev,
                            .carousel-control-next {
                                position: absolute;
                                top: 50%;
                                transform: translateY(-50%);
                                width: 40px;
                                height: 40px;
                                z-index: 5;
                            }

                            .carousel-control-prev {
                                left: -50px; /* نقل الزر خارج الصورة */
                            }

                            .carousel-control-next {
                                right: -50px; /* نقل الزر خارج الصورة */
                            }
                        </style>

                        <div class="carousel-inner">
                            @foreach ($donation->images as $image)
                            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                <div class="carousel-image-wrapper">
                                    <img src="{{ asset('uploads/' . $image->image) }}" alt="Image {{ $loop->index }}" data-bs-toggle="modal" data-bs-target="#imageModal" onclick="openModal('{{ asset('uploads/' . $image->image) }}')">
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">@lang('site.previous')</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">@lang('site.next')</span>
                        </button>
                    </div>

                    <!-- Modal to display full-size image -->
                    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <img id="modalImage" src="" class="img-fluid" alt="Full Image">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('site.close')</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script>
                        // Function to open the modal with the clicked image
                        function openModal(imageSrc) {
                            document.getElementById('modalImage').src = imageSrc;
                        }
                    </script>

                </div>

                {!! Form::open(['route' => ['donations.confirm', ['donation' => $donation->id]], 'method' => 'post'])
                !!}
                <div class="card-body">
                    <input type="hidden" name="id" value="{{ $donation->id }}">
                    <input type="hidden" name="type" value="{{ $donation->type }}">
                    <input type="hidden" name="doner_id" value="{{ $donation->doner_id }}">
                    <input type="hidden" name="case_id" value="{{ $donation->case_id }}">

                    @if ($donation->type == "price")
                    <!-- Price Input -->
                    <div class="col-12">
                        <label class="form-label">@lang('site.price')</label>
                        <input type="number" name="price" class="form-control" placeholder="@lang('site.enter_amount')"
                            min="0" />
                    </div>
                    @else
                    <!-- Items Input -->
                    <div class="col-12">
                        <div class="repeater">
                            <div data-repeater-list="items">
                                <div class="row align-items-center mb-3" data-repeater-item>
                                    <div class="col-md-5">
                                        <label>@lang('site.item')</label>
                                        <select name="item_id" class="form-select">
                                            @foreach ($categories as $category)
                                            <optgroup label="{{ $category->nameLang() }}">
                                                @foreach ($category->items as $item)
                                                <option value="{{ $item->id }}">{{ $item->nameLang() }}</option>
                                                @endforeach
                                            </optgroup>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label>@lang('site.amount')</label>
                                        <input type="number" name="amount" class="form-control" min="1" />
                                    </div>
                                    <div class="col-md-3 text-end">
                                        <button type="button" data-repeater-delete
                                            class="btn btn-danger mt-4">@lang('site.delete')</button>
                                    </div>
                                </div>
                            </div>
                            <button type="button" data-repeater-create
                                class="btn btn-primary">@lang('site.add_item')</button>
                        </div>
                    </div>
                    @endif
                </div>
                @if(auth()->user()->hasPermission('donations.update'))
                @include('admin.includes.form.submit-discard')
                @endif
                <br>
                {!! Form::close() !!}
                @else
                @if($donation->type!="price")
                <div class="card-datatable table-responsive">
                    <table class="table border-top">
                        <thead>
                            <tr>
                                <th>@lang("site.item")</th>
                                <th>@lang("site.price")</th>
                                <th>@lang("site.qty")</th>
                                <th>@lang("site.total")</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($donation->items as $item)
                            <tr>
                                <td>{{ $item->nameLang() }}</td>
                                <td>${{ $item->price }}</td>
                                <td>{{ $item->pivot->amount }}</td>
                                <td>${{ $item->price * $item->pivot->amount }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-end mt-3">
                        <h6>@lang("site.total"): ${{ $donation->get_price() }}</h6>
                    </div>
                </div>
                @else
                <div class="d-flex justify-content-center align-items-center py-4">
                    <div class="text-center p-3 rounded bg-light border border-primary shadow-sm"
                        style="max-width: 250px;">
                        <h5 class="fw-bold text-primary mb-2">@lang('site.donation_amount')</h5>
                        <p class="mb-0 display-6 fw-bold text-primary">${{ number_format($donation->get_price(), 2) }}
                        </p>
                    </div>
                </div>
                @endif
                @endif
            </div>
        </div>

        <div class="col-12 col-lg-4">
            <div class="card mb-6">
                <div class="card-header">
                    <h5 class="card-title m-0">@lang('site.doner_details')</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-start align-items-center mb-6">
                        <div class="avatar me-3">
                            @if ($donation->doner->image)
                            <img src="{{ asset('uploads/' . $donation->doner->image) }}" alt="Avatar"
                                class="rounded-circle">
                            @else
                            <img src="{{ asset('admin/assets/img/avatars/1.png') }}" alt="Avatar"
                                class="rounded-circle">
                            @endif
                        </div>
                        <div class="d-flex flex-column">
                            <a href="app-user-view-account.html" class="text-body text-nowrap">
                                <h6 class="mb-0">{{ $donation->doner->name }}</h6>
                            </a>
                            <span>{{ __('site.id') }}: #{{ $donation->doner->id }}</span>
                        </div>
                    </div>
                    <p class="mb-1">@lang('site.email'): {{ $donation->doner->email }}</p>
                    <p class="mb-0">@lang('site.phone'): {{ $donation->doner->phone }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.includes.modal.delete',["id"=>$donation->id,"main_name"=>"donations","name"=>"donation"])

@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.min.js"></script>
<script src={{ url("admin/assets/vendor/libs/select2/select2.js")}}></script>
<script src={{ url('js/repeaterConfirm.js') }}></script>
<script src={{ url("js/flashMessage.js")}}></script>
@endsection
