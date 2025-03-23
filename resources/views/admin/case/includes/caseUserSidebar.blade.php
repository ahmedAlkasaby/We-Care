<!-- User Sidebar -->
<div class="col-xl-4 col-lg-5 order-1 order-md-0">
    <!-- User Card -->
    <div class="card mb-6">
        <div class="card-body pt-12">
            <div class="user-avatar-section">
                <div class=" d-flex align-items-center flex-column">
                    @if(!$case->user->image)
                    <img class="img-fluid rounded mb-4" src="{{url("admin/assets/img/avatars/1.png")}}" height="120"
                        width="120" alt="User avatar">
                    @else
                    <img class="img-fluid rounded mb-4" src="{{ asset('uploads/' . $case->user->image)}}" height="120"
                        width="120" alt="User avatar">
                    @endif
                    <div class="user-info text-center">
                        <h5>{{$case->user->name}}</h5>
                    </div>
                </div>
                <br>
            </div>

            <h5 class="pb-4 border-bottom mb-4">@lang("site.details")</h5>
            <div class="info-container">
                <ul class="list-unstyled mb-6">
                    <li class="mb-2">
                        <span class="h6">@lang("site.name"):</span>
                        <span>{{$case->user->name}}</span>
                    </li>
                    <li class="mb-2">
                        <span class="h6">@lang("site.price"):</span>
                        <span>{{$case->price}}</span>
                    </li>
                    <li class="mb-2">
                        <span class="h6">@lang("site.price_raised"):</span>
                        <span>{{$case->price_raised}}</span>
                    </li>
                    <li class="mb-2">
                        <span class="h6">@lang("site.phone"):</span>
                        <span>{{$case->user->phone ?? null}}</span>
                    </li>
                    <li class="mb-2">

                        <span class="h6">@lang("site.email"):</span>
                        <span>{{$case->email ?? null}}</span>
                    </li>
                    <li class="mb-2">
                        <span class="h6">@lang("site.city"):</span>
                        <span>{{$city ?? null}}</span>
                    </li>
                    <li class="mb-2">
                        <span class="h6">@lang("site.region"):</span>
                        <span>{{$region ?? null}}</span>
                    </li>
                </ul>
                <div class="d-flex flex-column gap-2">
                    @if (auth()->user()->hasPermission('cases.update') && $case->can_edit())
                    <a class="edit-btn btn btn-primary waves-effect waves-light" href="{{route("
                        cases.edit",["case"=>$case->id])}}">
                        <i class="ti ti-pencil me-1"></i> @lang('site.Edit')
                    </a>
                    @else
                    <button disabled class="edit-btn btn btn-primary waves-effect waves-light" href="{{route("
                        cases.edit",["case"=>$case->id])}}">
                        <i class="ti ti-pencil me-1"></i> @lang('site.Edit')
                    </button>
                    @endif

                    @if (auth()->user()->hasPermission('transfers.store') && $case->this_case_need())
                    <button data-bs-toggle="modal" data-bs-target="#caseTransfer_{{ $case->id }}"
                        class="edit-btn btn btn-success waves-effect waves-light" href="{{route("
                        cases.edit",["case"=>$case->id])}}">
                        <span><i class="fa-solid fa-money-bill-transfer me-2"></i> <span
                                class="d-none d-sm-inline-block">@lang('site.transfer')</span></span>
                    </button>
                    @else
                    <button disabled data-bs-toggle="modal" data-bs-target="#caseTransfer_{{ $case->id }}"
                        class="edit-btn btn btn-success waves-effect waves-light" href="{{route("
                        cases.edit",["case"=>$case->id])}}">
                        <span><i class="fa-solid fa-money-bill-transfer me-2"></i> <span
                                class="d-none d-sm-inline-block">@lang('site.transfer')</span></span>
                    </button>
                    @endif
                    @include('admin.case.includes.transfer')
                </div>
            </div>
        </div>
    </div>
    <!-- /User Card -->
</div>

<!--/ User Sidebar -->