<div class="card-datatable table-responsive">
    @include('admin.includes.header_of_table',['model'=>'regions','filter'=>false,'entity'=>'region'])

    <table class="datatable table border-top">
        <thead>
            <tr>
                <th>ID</th>
                <th>@lang('site.name')</th>
                <th>@lang('site.city')</th>
                 <th class="text-lg-center">@lang('site.status')</th>

                <th class="text-lg-center">@lang('site.action')</th>
            </tr>
        </thead>
        <tbody>
            @if($regions->isNotEmpty())
            @foreach ($regions as $region)
            <tr class="{{ $loop->iteration % 2 == 0 ? 'even' : 'odd' }}">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $region->nameLang() }}</td>
                <td>{{ $region->city ? $region->city->nameLang() : __('site.null') }}</td>
                <td class="text-center">
                    <a href="{{ route('regions.toggle', ['region' => $region->id]) }}">
                        <button type="button"
                            class="btn {{ $region->active ? 'btn-success' : 'btn-danger' }} toggle-category waves-effect waves-light"
                            data-region-id="{{ $region->id }}">
                            <i class="fa-solid {{ $region->active ? 'fa-check' : 'fa-circle-xmark' }}"></i>
                        </button>
                    </a>
                </td>
                <td class="text-lg-center">
                    <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="ti ti-dots-vertical"></i>
                        </button>
                        <div class="dropdown-menu">
                            @if (auth()->user()->hasPermission('regions.update'))
                            <a class="dropdown-item edit-btn" href="#" data-bs-toggle="modal"
                                data-bs-target="#regionsForm" data-id="{{ $region->id }}"
                                data-name-en="{{ $region->nameLang('en') }}"
                                data-name-ar="{{ $region->nameLang('ar') }}" data-city-id="{{ $region->city_id }}">
                                <i class="ti ti-pencil me-1"></i> @lang('site.Edit')
                            </a>

                            @else
                            <button disabled class="dropdown-item">
                                <i class="ti ti-pencil me-1"></i> @lang('site.Edit')
                            </button>
                            @endif
                            @if (auth()->user()->hasPermission('category_cases.destroy'))

                            <button class="dropdown-item delete-btn" data-bs-toggle="modal"
                                data-bs-target="#deleteModal{{ $region->id }}">
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

            <!-- Modal for Deletion -->
            @include('admin.includes.modal.delete',["id"=>$region->id,"main_name"=>"regions","name"=>"region"])
            @endforeach
            @else
            <tr>
                <td colspan="4" class="text-center">@lang('site.there_is_no_data')</td>
            </tr>
            @endif
        </tbody>
    </table>
    <div class="m-3">

        {{ $regions->links() }}
    </div>
</div>
