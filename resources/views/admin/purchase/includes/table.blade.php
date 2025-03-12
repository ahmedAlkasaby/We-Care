<table class="datatable table border-top">
    <thead>
        <tr>
            <th>ID</th>
            <th class="text-nowrap text-sm-center">@lang('site.num_items')</th>
            <th class="text-nowrap text-sm-center">@lang('site.total_price')</th>
            <th class="text-nowrap text-sm-center">@lang('site.created_at')</th>


            <th class="text-lg-center">@lang('site.action')</th>
        </tr>
    </thead>
    <tbody>
        @if($purchases->isNotEmpty())
        @foreach ($purchases as $purchase)
        <tr class="{{ $loop->iteration % 2 == 0 ? 'even' : 'odd' }}">
            <td >{{ $loop->iteration }}</td>
            <td class="text-nowrap text-sm-center">
                <a href="#" class="badge bg-label-primary item-badge" style="font-size: larger;" data-bs-toggle="modal" data-bs-target="#itemModal{{ $purchase->id }}">
                    {{ $purchase->items->count() }}</td>
                </a>
            <td class="text-nowrap text-sm-center">
                <span class="badge bg-label-primary me-1">{{ $purchase->total_price }}</span>
            </td>
            <td class="text-nowrap text-sm-center">{{ $purchase->created_at->format('Y-M-D') }}</td>

            <td class="text-lg-center">
                <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                        data-bs-toggle="dropdown">
                        <i class="ti ti-dots-vertical"></i>
                    </button>
                    <ul class="dropdown-menu">
                        {{-- @if (auth()->user()->hasPermission('purchases-update'))
                        <li>
                            <a class="dropdown-item edit-btn" href="#"
                               data-bs-toggle="modal"
                               data-bs-target="#editPurchase"
                               data-items="{{ json_encode($purchase->items) }}">
                                <i class="ti ti-pencil me-1"></i> @lang('site.Edit')
                            </a>
                        </li>

                        @else
                        <li><button disabled class="dropdown-item"><i
                                class="ti ti-pencil me-1"></i> @lang('site.edit')</button>
                        </li>
                        @endif --}}
                        @if (auth()->user()->hasPermission('purchases.destroy'))

                        <button class="dropdown-item delete-btn" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $purchase->id }}">
                            <i class="ti ti-trash me-1"></i> @lang('site.delete')
                        </button>
                        @else

                        <button disabled class="dropdown-item delete-btn" >
                            <i class="ti ti-trash me-1"></i> @lang('site.delete')
                        </button>
                        @endif


                    </ul>

                </div>
            </td>
        </tr>
        @include('admin.includes.modal.items',["var"=>$purchase])

        @include('admin.includes.modal.delete',["id"=>$purchase->id,"main_name"=>"purchases","name"=>"purchase"])
        @include('admin.includes.modal.items',["var"=>$purchase])
        @endforeach
        @else
        <tr>
            <td colspan="5" class="text-center">@lang('site.there_is_no_data')</td>
        </tr>
        @endif
    </tbody>
</table>
