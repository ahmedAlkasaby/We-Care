<table class="datatable table border-top">
    <thead>
        <tr>
            <th>ID</th>
            <th>@lang('site.name')</th>
            <th class="text-lg-center">@lang('site.status')</th>


            <th class="text-lg-center">@lang('site.action')</th>
        </tr>
    </thead>
    <tbody>
        @if($cities->isNotEmpty())
        @foreach ($cities as $city)
        <tr class="{{ $loop->iteration % 2 == 0 ? 'even' : 'odd' }}">
            <td>{{ $loop->iteration }}</td>
            <td>{{ $city->nameLang() }}</td>
            <td class="text-center">
                <a href="{{ route('cities.toggle', ['city' => $city->id]) }}">
                    <button type="button"
                        class="btn {{ $city->active ? 'btn-success' : 'btn-danger' }} toggle-category waves-effect waves-light"
                        data-city-id="{{ $city->id }}">
                        <i class="fa-solid {{ $city->active ? 'fa-check' : 'fa-circle-xmark' }}"></i>
                    </button>
                </a>
            </td>

            <td class="text-lg-center">
                <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="ti ti-dots-vertical"></i>
                    </button>
                    <div class="dropdown-menu">
                        @if (auth()->user()->hasPermission('cities.update'))
                        <a class="dropdown-item edit-btn" href="#" data-bs-toggle="modal" data-bs-target="#citiesForm"
                            data-id="{{ $city->id }}" data-name-en="{{ $city->nameLang('en') }}"
                            data-name-ar="{{ $city->nameLang('ar') }}">
                            <i class="ti ti-pencil me-1"></i> @lang('site.Edit')
                        </a>

                        @else
                        <button disabled class="dropdown-item">
                            <i class="ti ti-pencil me-1"></i> @lang('site.Edit')
                        </button>
                        @endif
                        @if (auth()->user()->hasPermission('category_cases.destroy'))

                        <button class="dropdown-item delete-btn" data-bs-toggle="modal"
                            data-bs-target="#deleteModal{{ $city->id }}">
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
        @include('admin.includes.modal.delete',["id"=>$city->id,"main_name"=>"cities","name"=>"city"])
        @endforeach
        @else
        <tr>
            <td colspan="4" class="text-center">@lang('site.there_is_no_data')</td>
        </tr>
        @endif
    </tbody>
</table>
<div class="m-3">
    {{ $cities->links() }}
</div>
</div>
</div>
