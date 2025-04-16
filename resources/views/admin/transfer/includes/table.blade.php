<div class="table-responsive text-nowrap">
    @if (Route::is('transfers.index'))
    @include('admin.transfer.includes.filter')
    @endif
    <table class="datatable table border-top">
        <thead>
            <tr>
                <th>ID</th>
                <th>@lang('site.cases')</th>
                <th>@lang('site.transfer(money)')</th>
                <th>@lang('site.type')</th>
                <th>@lang('site.status')</th>
                <th>@lang('site.time')</th>

                <th class="text-lg-center">@lang('site.action')</th>
            </tr>
        </thead>
        @if ($transfers->count()>0)
        <tbody class="table-border-bottom-0">
            @foreach ($transfers as $transfer)
            <tr>
                <td>{{ $loop->iteration }}</td>

                <td>{{ $transfer->case->user->name }}</td>
                <td>{{ $transfer->price }}</td>
                <td>
                    @if($transfer->type=='items')
                    <a href="#" class="badge bg-label-success me-1 item-badge" data-bs-toggle="modal"
                        data-bs-target="#itemModal{{ $transfer->id }}">
                        {{ __('site.items')}}
                    </a>
                    @else
                    <span class="badge bg-label-success me-1 item-badge">
                        {{ __('site.price')}}
                    </span>
                    @endif
                </td>
                <td>
                    <span class="badge bg-label-success me-1">
                        {{ $transfer->donation_id ? __('site.donation') : __('site.storage') }}
                    </span>
                </td>
                <td>{{ $transfer->created_at->format('Y-M-D') }}</td>


                <td class="text-lg-center">
                    <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="ti ti-dots-vertical"></i>
                        </button>
                        <ul class="dropdown-menu">
                            @if (auth()->user()->hasPermission('transfers.destroy'))
                            <button class="dropdown-item delete-btn" data-bs-toggle="modal"
                                data-bs-target="#deleteModal{{ $transfer->id }}">
                                <i class="ti ti-trash me-1"></i> @lang('site.delete')
                            </button>
                            @else
                            <button class="dropdown-item" disabled>
                                <i class="ti ti-trash me-1"></i> @lang('site.delete')
                            </button>
                            @endif
                            @if (auth()->user()->hasPermission('transfers.index'))
                            <a class="dropdown-item" href="{{ route('transfers.show',['transfer'=>$transfer->id]) }}"><i
                                    class="ti ti-eye me-1"></i> @lang('site.show')</a>
                            @else
                            <button class="dropdown-item" disabled>
                                <i class="ti ti-eye me-1"></i> @lang('site.show')
                            </button>
                            @endif

                        </ul>
                    </div>
                </td>
            </tr>
            @include('admin.includes.modal.delete',["id"=>$transfer->id,"main_name"=>"transfers","name"=>"transfer"])
            @include('admin.includes.modal.items',["var"=>$transfer])

            @endforeach

            @else
            <tr>
                <td colspan="8" class="text-center">@lang('site.there_is_no_data')</td>
            </tr>
            @endif
        </tbody>

    </table>
    <div class="m-3">

        {{ $transfers->links() }}
    </div>
</div>