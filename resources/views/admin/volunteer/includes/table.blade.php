<div class="card">
    <div class="card-datatable table-responsive">
        @include('admin.includes.header_of_table',['model'=>'volunteers','filter'=>false,'entity'=>'volunteer'])

        <table class="datatable table table-striped border-top">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>@lang('site.volunteers')</th>
                    <th>@lang('site.gender')</th>
                    <th class="text-nowrap text-sm-center">@lang('site.cases')</th>
                    <th class="text-nowrap text-sm-center">@lang('site.phone')</th>
                    <th class="text-nowrap text-sm-center">@lang('site.address')</th>
                    <th class="text-lg-center">@lang('site.action')</th>
                </tr>
            </thead>
            <tbody>
                @if($volunteers->isNotEmpty())
                    @foreach ($volunteers as $volunteer)
                        <tr class="{{ $loop->iteration % 2 == 0 ? 'even' : 'odd' }}">
                            <td>{{ $volunteer->id }}</td>
                            <td>{{ $volunteer->name }}</td>
                            <td>{{ $volunteer->gender=="male" ? __("site.male") : __("site.female") }}</td>
                            <td class="text-nowrap text-sm-center">
                                <button type="button" class="btn btn-primary" {{ $volunteer->cases > 0 ? '' : 'disabled' }}>
                                    <a href="{{ route('cases.index', ['volunteer_id' => $volunteer->id]) }}" class="text-white">
                                        {{ $volunteer->cases }}
                                        <i class="fa-solid fa-hands-holding-child ms-1 me-3"></i>
                                    </a>
                                </button>
                            </td>
                            <td class="text-nowrap text-sm-center">
                                <span class="badge bg-label-success me-1">{{ $volunteer->phone }}</span>
                            </td>
                            <td class="text-nowrap text-sm-center">
                                <div class="d-flex flex-column">
                                    <span class="badge bg-label-success me-1 mb-1">{{ $volunteer->city ? $volunteer->city->nameLang() : __('site.null')}}</span>
                                    <span class="badge bg-label-primary me-1">{{ $volunteer->region ?  $volunteer->region->nameLang() : __('site.null')}}</span>
                                </div>
                            </td>
                            <td class="text-lg-center">
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="ti ti-dots-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            @if (auth()->user()->hasPermission('volunteers.update'))
                                            <a class="dropdown-item edit-btn" href="#"
                                               data-bs-toggle="modal"
                                               data-bs-target="#volunteersForm"
                                               data-id="{{ $volunteer->id }}"
                                               data-name="{{ $volunteer->name }}"
                                               data-phone="{{ $volunteer->phone }}"
                                               data-city="{{ $volunteer->city_id }}"
                                               data-region="{{ $volunteer->region_id }}"
                                               data-gender="{{ $volunteer->gender }}"
                                               data-lang="{{ $volunteer->lang }}">
                                                <i class="ti ti-pencil me-1"></i> @lang('site.Edit')
                                            </a>

                                            @else
                                            <button disabled class="dropdown-item">
                                                <i class="ti ti-pencil me-1"></i> @lang('site.Edit')
                                            </button>
                                            @endif
                                        </li>
                                        <li>
                                            @if (auth()->user()->hasPermission('volunteers.destroy'))
                                            <button class="dropdown-item delete-btn" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $volunteer->id }}">
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
                        @include('admin.includes.modal.delete',["id"=>$volunteer->id,"main_name"=>"volunteers","name"=>"volunteer"])
                    @endforeach
                @else
                    <tr>
                        <td colspan="7" class="text-center">@lang('site.there_is_no_data')</td>
                    </tr>
                @endif
            </tbody>
        </table>
        <div class="m-3">
            {{ $volunteers->links() }}
        </div>
    </div>
</div>
