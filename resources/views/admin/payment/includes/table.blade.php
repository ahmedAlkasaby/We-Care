<table class="datatable table border-top">
    <thead>
        <tr>
            <th class="text-lg-center">ID</th>
            <th class="text-lg-center">@lang('site.name')</th>
            <th class="text-lg-center">@lang('site.action')</th>
        </tr>
    </thead>
    <tbody>
        @if($payments->isNotEmpty())
            @foreach ($payments as $payment)
                <tr class="{{ $loop->iteration % 2 == 0 ? 'even' : 'odd' }}">
                    <td class="text-lg-center">{{ $loop->iteration }}</td>
                    <td class="text-lg-center">{{ $payment->nameLang() }}</td>
                    <td class="text-lg-center">
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="ti ti-dots-vertical"></i>
                            </button>
                            <div class="dropdown-menu">
                                @if (auth()->user()->hasPermission('payments.update'))
                                <a class="dropdown-item edit-btn" href="#" data-bs-toggle="modal"
                                    data-bs-target="#adminShow"
                                    data-id="{{ $payment->id }}"
                                    data-name-en="{{ $payment->nameLang('en') }}"
                                    data-name-ar="{{ $payment->nameLang('ar') }}">
                                    <i class="ti ti-pencil me-1"></i> @lang('site.Edit')
                                    </a>
                                @else
                                <button disabled class="dropdown-item">
                                    <i class="ti ti-pencil me-1"></i> @lang('site.Edit')
                                </button>
                                @endif
                                @if (auth()->user()->hasPermission('payments.destroy'))
                                <button class="dropdown-item delete-btn" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $payment->id }}">
                                    <i class="ti ti-trash me-1"></i> @lang('site.delete')
                                </button>
                                @else
                                <button class="dropdown-item" disabled>
                                    <i class="ti ti-trash me-1"></i> @lang('site.delete')
                                </button>
                                @endif
                            </div>
                        </div>
                    </td>
                </tr>
                @include('admin.includes.modal.delete',["id"=>$payment->id,"main_name"=>"payments","name"=>"payment"])
                @endforeach
        @else
            <tr>
                <td colspan="3" class="text-center">@lang('site.there_is_no_data')</td>
            </tr>
        @endif
    </tbody>
</table>
<div class="m-3">
    {{ $payments->links() }}
</div>
