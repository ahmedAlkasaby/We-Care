<table class="datatable table table-striped border-top">
    <thead>
        <tr>
            <th>ID</th>
            <th>@lang('site.doners')</th>
            <th>@lang('site.gender')</th>
            <th class="text-nowrap text-sm-center">@lang('site.total_donation')</th>
            <th class="text-nowrap text-sm-center">@lang('site.phone')</th>
            <th class="text-nowrap text-sm-center">@lang('site.address')</th>
            <th class="text-lg-center">@lang('site.action')</th>
        </tr>
    </thead>
    <tbody>
        @if($doners->count() >0)
        @foreach ($doners as $doner)
        <tr class="{{ $loop->iteration % 2 == 0 ? 'even' : 'odd' }}">
            <td>{{ $loop->iteration }}</td>
            <td><a href="{{ route('doners.show', ['doner' => $doner->id]) }}">{{ $doner->name }}</a></td>
            <td>{{ __("site.$doner->gender") }}</td>
            <td class="text-nowrap text-sm-center">{{ $doner->amount }}</td>
            <td class="text-nowrap text-sm-center">
                <span class="badge bg-label-success me-1">{{ $doner->phone }}</span>
            </td>
            <td class="text-nowrap text-sm-center">
                <div class="d-flex flex-column">
                    <span class="badge bg-label-success me-1 mb-1">{{ $doner->city ? $doner->city->nameLang() :
                        __('site.null')}}</span>
                    <span class="badge bg-label-primary me-1">{{ $doner->region ? $doner->region->nameLang() :
                        __('site.null')}}</span>
                </div>
            </td>
            <td class="text-lg-center">
                <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="ti ti-dots-vertical"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            @if (auth()->user()->hasPermission('doners.update'))
                            <a class="dropdown-item edit-btn" href="#" data-bs-toggle="modal"
                                data-bs-target="#donersForm" data-id="{{ $doner->id }}" data-name="{{ $doner->name }}"
                                data-phone="{{ $doner->phone }}" data-city="{{ $doner->city_id }}"
                                data-region="{{ $doner->region_id }}" data-gender="{{ $doner->gender }}"
                                data-lang="{{ $doner->lang }}">
                                <i class="ti ti-pencil me-1"></i> @lang('site.Edit')
                            </a>

                            @else
                            <button disabled class="dropdown-item">
                                <i class="ti ti-pencil me-1"></i> @lang('site.Edit')
                            </button>
                            @endif
                        </li>
                        <li>
                            @if (auth()->user()->hasPermission('doners.index'))
                            <a class="dropdown-item" href="{{route("doners.show",["doner"=>$doner->id])}}"><i
                                    class="ti ti-eye me-1"></i> {{__("site.show")}}</a>
                            @else
                            <button disabled class="dropdown-item">
                                <i class="ti ti-eye me-1"></i> {{__("site.show")}}
                            </button>
                            @endif
                        </li>

                        <li>
                            @if (auth()->user()->hasPermission('doners.destroy'))
                            <button class="dropdown-item delete-btn" data-bs-toggle="modal"
                                data-bs-target="#deleteModal{{ $doner->id }}">
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
        @include('admin.includes.modal.delete',["id"=>$doner->id,"main_name"=>"doners","name"=>"doner"])
        @endforeach
        @else
        <tr>
            <td colspan="7" class="text-center">@lang('site.there_is_no_data')</td>
        </tr>
        @endif
    </tbody>
</table>
<div class="m-3">
    {{ $doners->links() }}
</div>
