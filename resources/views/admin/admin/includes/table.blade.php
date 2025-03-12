<table class="datatable table table-striped border-top">
    <thead>
        <tr>
            <th>ID</th>
            <th>@lang('site.admins')</th>
            <th class="text-nowrap text-sm-center">@lang('site.role')</th>
            <th class="text-nowrap text-sm-center">@lang('site.phone')</th>
            <th class="text-lg-center">@lang('site.action')</th>
        </tr>
    </thead>
    <tbody>
        @if($admins->isNotEmpty())
        @foreach ($admins as $admin)
        <tr class="{{ $loop->iteration % 2 == 0 ? 'even' : 'odd' }}">
            <td>{{ $loop->iteration }}</td>
            <td>{{ $admin->name }}</td>
            <td class="text-nowrap text-sm-center"> @foreach ($admin->roles as $role)
                <span class="badge text-bg-primary">{{ $role->name }}</span>
                @endforeach
            </td>
            <td class="text-nowrap text-sm-center">
                <span class="badge bg-label-success me-1">{{ $admin->phone }}</span>
            </td>
            <td class="text-lg-center">
                <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                        data-bs-toggle="dropdown">
                        <i class="ti ti-dots-vertical"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            @if (auth()->user()->hasPermission('admins.update'))

                            <a class="dropdown-item edit-btn" href="#" data-bs-toggle="modal"
                                data-bs-target="#adminsForm" data-id="{{ $admin->id }}"
                                data-bs-target="#adminsForm" data-id="{{ $admin->id }}"
                                data-name="{{ $admin->name }}"
                                data-phone="{{ $admin->phone }}"
                                data-roles="{{ $admin->roles->pluck('id')->implode(',') }}"
                                data-lang="{{ $admin->lang }}"
                                data-region="{{ $admin->region_id }}"
                                data-city="{{ $admin->city_id }}"
                                data-gender="{{ $admin->gender }}"
                                >
                                <i class="ti ti-pencil me-1"></i> @lang('site.Edit')
                            </a>
                            @else
                            <button disabled class="dropdown-item">
                            <i class="ti ti-pencil me-1"></i> @lang('site.Edit')
                            </button>

                            @endif

                            @if (auth()->user()->hasPermission('admins.destroy'))

                            <button class="dropdown-item delete-btn" data-bs-toggle="modal"
                                data-bs-target="#deleteModal{{ $admin->id }}">
                                <i class="ti ti-trash me-1"></i> @lang('site.delete')
                            </button>
                            @else
                            <button class="dropdown-item" disabled>
                            <i class="ti ti-trash me-1"></i> @lang('site.delete')
                           </button>
                            @endif
                        </li>
                    </ul>
                </div>
            </td>
        </tr>
        @include('admin.includes.modal.delete',["id"=>$admin->id,"main_name"=>"admins","name"=>"admin"])
        @endforeach
        @else
        <tr>
            <td colspan="6" class="text-center">@lang('site.there_is_no_data')</td>
        </tr>
        @endif
    </tbody>
</table>
<div class="m-3">

    {{ $admins->links() }}
</div>
