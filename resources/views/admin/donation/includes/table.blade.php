<table class="datatable table border-top">
    <thead>
        <tr>
            <th>ID</th>
            <th>@lang('site.doner')</th>
            <th class="text-nowrap text-sm-center">@lang('site.type')</th>
            <th class="text-nowrap text-sm-center">@lang('site.price_doner')</th>
            <th class="text-nowrap text-sm-center">@lang('site.price')</th>
            <th class="text-nowrap text-sm-center">@lang('site.case')</th>
            <th class="text-nowrap text-sm-center">@lang('site.time')</th>
            <th class="text-nowrap text-sm-center">@lang('site.confirmed')</th>
            <th class="text-lg-center">@lang('site.action')</th>
        </tr>
    </thead>
    <tbody>
        @if($donations->isNotEmpty())
        @foreach ($donations as $donation)
        <tr class="{{ $loop->iteration % 2 == 0 ? 'even' : 'odd' }}">
            <td>{{ $loop->iteration }}</td>
            <td>{{ $donation->doner->name ?? null}}</td>
            <td class="text-nowrap text-sm-center">
                @if($donation->type=="items")
                <a href="#" class="badge bg-label-success me-1 item-badge" data-bs-toggle="modal"
                    data-bs-target="#itemModal{{ $donation->id }}">
                    {{ __('site.items')}}
                </a>
                @else
                <span class="badge bg-label-success me-1 item-badge">
                    {{ __('site.price')}}
                </span>
                @endif
            </td>
            <td class="text-nowrap text-sm-center">
                <span class="badge bg-label-primary me-1">{{ $donation->get_price() }}</span>
            </td>
            <td class="text-nowrap text-sm-center">
                <span class="badge bg-label-secondary me-1">{{ $donation->get_doner_price()
                    }}</span>
            </td>

            <td class="text-nowrap text-sm-center">{{ $donation->case ?
                $donation->case->user->name : __('site.null') }}</td>
            <td class="text-nowrap text-sm-center">{{ $donation->created_at->format('Y-M-D') }}
            </td>
            <td class="text-center">
                @if($donation->confirm == 0)
                    @if(auth()->user()->hasPermission('donations.update'))
                        @if($donation->type == "price")
                            <a class="confirm-price-btn" href="#" data-bs-toggle="modal" data-bs-target="#confirsmModalPrice"
                                data-id="{{ $donation->id }}" data-case-id="{{ $donation->case_id }}"
                                data-doner-id="{{ $donation->doner_id }}" data-type="{{ $donation->type }}"
                                data-image="{{ asset('uploads/' . $donation->images->first()->image) }}">
                                <span class="badge bg-label-danger">@lang('site.no')</span>
                            </a>
                        @else
                            <a class="confirm-btn" href="{{ route('donations.show', $donation->id) }}">
                                <span class="badge bg-label-danger">@lang('site.no')</span>
                            </a>
                        @endif
                    @else
                        <span class="badge bg-label-danger">@lang('site.no')</span>
                    @endif
                @else
                    <span class="badge bg-label-success">@lang('site.yes')</span>
                @endif
            </td>


            <td class="text-lg-center">
                <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="ti ti-dots-vertical"></i>
                    </button>
                    <ul class="dropdown-menu">
                        @if(auth()->user()->hasPermission('donations.update'))
                            @if($donation->case)
                                @if($donation->case->items->count() > 0)
                                    <button data-bs-toggle="modal" data-bs-target="#donationTransferItems_{{ $donation->id }}" class="dropdown-item" type="button">
                                        <span><i class="ti ti-file-export me-sm-1"></i> <span class="d-none d-sm-inline-block">@lang('site.transfer')</span></span>
                                    </button>
                                @else
                                    <button data-bs-toggle="modal" data-bs-target="#donationTransferPrice_{{ $donation->id }}" class="dropdown-item" type="button">
                                        <span><i class="ti ti-file-export me-sm-1"></i> <span class="d-none d-sm-inline-block">@lang('site.transfer')</span></span>
                                    </button>
                                @endif
                            @else
                                <button disabled class="dropdown-item" type="button">
                                    <span><i class="ti ti-file-export me-sm-1"></i> <span class="d-none d-sm-inline-block">@lang('site.transfer')</span></span>
                                </button>
                            @endif
                        @endif

                        @if(auth()->user()->hasPermission('donations.destroy'))
                            @if($donation->confirm == 0)
                                <button class="dropdown-item delete-btn" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $donation->id }}">
                                    <i class="ti ti-trash me-1"></i> @lang('site.delete')
                                </button>
                            @else
                                <button class="dropdown-item delete-btn" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $donation->id }}" disabled>
                                    <i class="ti ti-trash me-1"></i> @lang('site.delete')
                                </button>
                            @endif
                        @endif
                        @if(auth()->user()->hasPermission('donations.index'))
                        <a href="{{ route('donations.show', $donation->id) }}" class="dropdown-item">
                            <i class="ti ti-eye me-1"></i> @lang('site.show')
                        </a>
                        @else
                        <button class="dropdown-item" disabled>
                            <i class="ti ti-eye me-1"></i> @lang('site.show')
                        </button>
                        @endif
                    </ul>
                </div>
            </td>

        </tr>
        @include('admin.includes.modal.items',["var"=>$donation])
        @include('admin.donation.includes.confirm_price')
        @include('admin.includes.modal.delete',["id"=>$donation->id,"main_name"=>"donations","name"=>"donation"])
        @endforeach
        @else
        <tr>
            <td colspan="8" class="text-center">@lang('site.there_is_no_data')</td>
        </tr>
        @endif
    </tbody>
</table>
