<table class="datatable table table-sm border-top">
    <thead>
        <tr>
            <th>ID</th>
            <th>@lang('site.name')</th>
            <th>@lang('site.category')</th>
            <th>@lang('site.priority')</th>
            <th>@lang('site.type_case_need')</th>
            <th>@lang('site.total_price')</th>
            <th>@lang('site.remain_price')</th>
            <th>@lang('site.next_donation_date')</th>
            <th>@lang('site.status')</th>
            <th>@lang('site.active')</th>
            <th>@lang('site.action')</th>
        </tr>
    </thead>

    @if ($cases->count()>0)
    <tbody class="table-border-bottom-0">
        @foreach ($cases as $case)
        <tr id="case-row-{{ $case->id }}">
            <td>{{ $case->id }}</td>
            <td>{{ $case->user->name }}</td>
            <td>{{ $case->category ? $case->category->nameLang() : null }}</td>
            <td>{{ __('site.'.$case->priority) }}</td>
            <td class="text-nowrap text-sm-center">
                @if($case->type == 'items')
                <a href="#" class="badge bg-label-success me-1 item-badge" data-bs-toggle="modal"
                    data-bs-target="#itemModal{{ $case->id }}">
                    {{ __('site.items')}}
                </a>
                @else
                <span class="badge bg-label-success me-1 item-badge">
                    {{ __('site.price')}}
                </span>
                @endif
            </td>
            <td id="case-price-{{ $case->id }}">{{ $case->price }}</td>
            <td id="case-remaining-{{ $case->id }}">{{ $case->price - $case->price_raised }}</td>
            <td>
                @if ($case->next_donation_date)
                {{ \Carbon\Carbon::parse($case->next_donation_date)->format('Y-M-d') }}
                @else
                @lang('site.null')
                @endif
            </td>
            <td><span class="{{ $case->get_class_status($case->check_status()) }} case-status-{{ $case->id }}">{{
                    $case->check_status() }}</span></td>

            <td>
                @if($case->archive || $case->done==0 ||  ! auth()->user()->hasPermission('cases.toggle'))
                <button disabled type="button" class="btn btn-danger"><i class="fa-solid fa-circle-xmark"></i></button>
                @else
                <button type="button" class="btn {{
                    $case->active ? 'btn-success' : 'btn-danger' }} toggle-case" data-case-id="{{
                    $case->id }}">
                    <i class="fa-solid {{ $case->active ? 'fa-check' : 'fa-circle-xmark' }}"></i>
                </button>
                @endif

            </td>



            <td class="text-lg-center">
                <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="ti ti-dots-vertical"></i>
                    </button>
                    <ul class="dropdown-menu">
                        @if (auth()->user()->hasPermission('cases.update') && $case->can_edit())
                        <a class="dropdown-item" href="{{ route('cases.edit',['case'=>$case->id]) }}"><i
                                class="ti ti-pencil me-1"></i> @lang('site.edit')</a>
                        @else
                        <button disabled class="dropdown-item"><i class="ti ti-pencil me-1"></i>
                            @lang('site.edit')</button>
                        @endif


                      
                        @if ($case->archive==1)
                        @if ($case->check_status()=='finish')
                        <button type="button" disabled class="dropdown-item"><span><i
                                    class="fa-solid fa-recycle"></i><span
                                    class="d-none d-sm-inline-block">@lang('site.remove_from_archive')</span></span></button>
                        @else
                        <a href="{{ route('cases.RemoveFromArchive',['case'=>$case->id]) }}"> <button type="button"
                                class="dropdown-item"><span><i class="fa-solid fa-recycle"></i><span
                                        class="d-none d-sm-inline-block">@lang('site.remove_from_archive')</span></span></button></a>
                        @endif
                        @else
                        <a href="{{ route('cases.archive',['case'=>$case->id]) }}">
                            <button type="button" class="dropdown-item">
                                <span><i class="fa-solid fa-box-archive "></i><span
                                        class="d-none d-sm-inline-block">@lang('site.archive')</span></span>
                            </button>
                        </a>
                        @endif


                        @if (auth()->user()->hasPermission('transfers.store') && $case->this_case_need())
                        <button data-bs-toggle="modal" data-bs-target="#caseTransfer_{{ $case->id }}"
                            class="dropdown-item transfer-button-{{ $case->id }}" type="button">
                            <span><i class="fa-solid fa-money-bill-transfer me-2"></i><span
                                    class="d-none d-sm-inline-block">@lang('site.transfer')</span></span>
                        </button>
                        @else
                        <button data-bs-toggle="modal" data-bs-target="#caseTransfer_{{ $case->id }}" disabled
                            class="dropdown-item transfer-button-{{ $case->id }}" type="button">
                            <span><i class="fa-solid fa-money-bill-transfer me-2"></i> <span
                                    class="d-none d-sm-inline-block">@lang('site.transfer')</span></span>
                        </button>
                        @endif
                        @if (auth()->user()->hasPermission('cases.index') && $case->done==1)
                        <a class="dropdown-item" href="{{ route('cases.show',['case'=>$case->id]) }}"><i
                                class="ti ti-eye me-1"></i> @lang('site.show')</a>
                        @else
                        <button disabled class="dropdown-item"><i class="ti ti-eye me-1"></i> @lang('site.show')</button>
                        @endif

                    </ul>
                    @include('admin.case.includes.transfer')

                </div>
            </td>
        </tr>
        @include('admin.includes.modal.items',["var"=>$case])

        @endforeach

        @else
        <tr>
            <td colspan="11" class="text-center">@lang('site.there_is_no_data')</td>
        </tr>
        @endif
    </tbody>

</table>

<div class="m-3">
    {{ $cases->links() }}
</div>
