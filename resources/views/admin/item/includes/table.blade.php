<table class="datatable table border-top">
    <thead>
        <tr>
            <th>ID</th>
            <th>@lang('site.item')</th>
            <th class="text-nowrap text-sm-center">@lang('site.category')</th>
            <th class="text-nowrap text-sm-center">@lang('site.price')</th>
            <th class="text-lg-center">@lang('site.status')</th>

            <th class="text-lg-center">@lang('site.action')</th>
        </tr>
    </thead>
    <tbody>
        @if($items->isNotEmpty())
        @foreach ($items as $item)
        <tr class="{{ $loop->iteration % 2 == 0 ? 'even' : 'odd' }}">
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->nameLang() }}</td>
            <td class="text-nowrap text-sm-center">
                <span class="badge bg-label-success me-1">{{ $item->category->nameLang() }}</span>
            </td>
            <td class="text-center">
                <span class="badge bg-label-primary">
                    {{ $item->price }}
                </span>
            </td>
            <td class="text-center">
                <a href="{{ route('items.toggle', ['item' => $item->id]) }}">
                    <button type="button"
                        class="btn {{ $item->active ? 'btn-success' : 'btn-danger' }} toggle-category waves-effect waves-light"
                        data-item-id="{{ $item->id }}">
                        <i class="fa-solid {{ $item->active ? 'fa-check' : 'fa-circle-xmark' }}"></i>
                    </button>
                </a>
            </td>
            <td class="text-lg-center">
                <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                        data-bs-toggle="dropdown">
                        <i class="ti ti-dots-vertical"></i>
                    </button>
                    <div class="dropdown-menu">
                        @if (auth()->user()->hasPermission('items.update'))
                        <a class="dropdown-item edit-btn" href="#" data-bs-toggle="modal"
                            data-bs-target="#itemsForm" data-id="{{ $item->id }}"
                            data-name-en="{{ $item->nameLang('en') }}"
                            data-name-ar="{{ $item->nameLang('ar') }}"
                            data-desc-en="{{ $item->descriptionLang('en') }}"
                            data-desc-ar="{{ $item->descriptionLang('ar') }}"
                            data-price="{{ $item->price }}"
                            data-category_id="{{ $item->category_id }}">
                            <i class="ti ti-pencil me-1"></i> @lang('site.Edit')
                        </a>
                        @else
                        <button disabled class="dropdown-item">
                            <i class="ti ti-pencil me-1"></i> @lang('site.edit')
                        </button>
                        @endif


                        @if (auth()->user()->hasPermission('items.destroy'))
                        <button class="dropdown-item delete-btn" data-bs-toggle="modal"
                            data-bs-target="#deleteModal{{ $item->id }}">
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
        @include('admin.includes.modal.delete',["id"=>$item->id,"main_name"=>"items","name"=>"item"])


        @endforeach
        @else
        <tr>
            <td colspan="5" class="text-center">@lang('site.there_is_no_data')</td>
        </tr>
        @endif
    </tbody>
</table>
<div class="m-3">
    {{ $items->links() }}
</div>
