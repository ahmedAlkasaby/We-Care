<table class="datatable table border-top">
    <thead>
        <tr>
            <th>ID</th>
            <th >@lang('site.user')</th>
            <th >@lang('site.description')</th>
            <th >@lang('site.created_at')</th>
            <th class="text-lg-center">{{ __("site.action") }}</th>
        </tr>
    </thead>

    <tbody>
        @if ($logs->isNotEmpty())
            @foreach ($logs as $log)
                <tr class="{{ $loop->iteration % 2 == 0 ? 'even' : 'odd' }}">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $log->user?->name ?? '—' }}</td>
                    <td>{{ $log->description }}</td>
                    <td >{{ $log->created_at }}</td>
                    <td class="text-lg-center">
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="ti ti-dots-vertical"></i>
                            </button>
                            <ul class="dropdown-menu">
                                @if (auth()->user()->hasPermission('logs.destroy'))
                                    <button class="dropdown-item delete-btn" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $log->id }}">
                                        <i class="ti ti-trash me-1"></i> @lang('site.delete')
                                    </button>
                                @else
                                    <button disabled class="dropdown-item delete-btn">
                                        <i class="ti ti-trash me-1"></i> @lang('site.delete')
                                    </button>
                                @endif
                            </ul>
                        </div>
                    </td>
                </tr>

                {{-- تضمين المودال الخاص بالحذف --}}
                {{-- @include('admin.includes.modal.delete', ["id" => $log->id, "main_name" => "logs", "name" => "log"]) --}}
            @endforeach
        @else
            <tr>
                <td colspan="5" class="text-center">@lang('site.there_is_no_data')</td>
            </tr>
        @endif
    </tbody>
</table>

