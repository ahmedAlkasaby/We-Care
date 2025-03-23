<table class="datatable table border-top">
    <thead>
        <tr>
            <th>ID</th>
            <th>@lang('site.user')</th>
            <th>@lang('site.description')</th>
            <th>@lang('site.created_at')</th>
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
                    <td>{{ $log->created_at }}</td>
                    <td class="text-lg-center">
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="ti ti-dots-vertical"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#logDetailsModal{{ $log->id }}">
                                    <i class="ti ti-eye me-1"></i> @lang('site.view_details')
                                </button>

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
            @endforeach
        @else
            <tr>
                <td colspan="5" class="text-center">@lang('site.there_is_no_data')</td>
            </tr>
        @endif
    </tbody>
</table>

<!-- المودالات خارج الجدول -->
@foreach ($logs as $log)
    @php
        // تأكد من أن `properties` نص وليس مصفوفة
        $properties = is_string($log->properties) ? json_decode($log->properties, true) : $log->properties;

        $oldData = $properties['old'] ?? [];
        $newData = $properties['new'] ?? [];
    @endphp

    <div class="modal fade" id="logDetailsModal{{ $log->id }}" tabindex="-1" aria-labelledby="logDetailsLabel{{ $log->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logDetailsLabel{{ $log->id }}">@lang('site.log_details')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>@lang('site.field')</th>
                                <th>@lang('site.old_value')</th>
                                <th>@lang('site.new_value')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($oldData as $key => $oldValue)
                                @php
                                    $newValue = $newData[$key] ?? '—';

                                    // تنسيق القيم لتكون مقروءة
                                    if (is_array($oldValue)) {
                                        $oldValue = json_encode($oldValue, JSON_UNESCAPED_UNICODE);
                                    }
                                    if (is_array($newValue)) {
                                        $newValue = json_encode($newValue, JSON_UNESCAPED_UNICODE);
                                    }

                                    // تحويل القيم المعروفة إلى شكل أوضح
                                    $formattedKey = __("site.$key") ?? $key;
                                    if (Str::contains($key, ['date', 'created_at', 'updated_at'])) {
                                        $oldValue = $oldValue !== '—' ? \Carbon\Carbon::parse($oldValue)->format('d M Y - h:i A') : '—';
                                        $newValue = $newValue !== '—' ? \Carbon\Carbon::parse($newValue)->format('d M Y - h:i A') : '—';
                                    }
                                    if ($key === 'name' || $key === 'description') {
                                        $oldValue = json_decode($oldValue, true)[app()->getLocale()] ?? '—';
                                        $newValue = json_decode($newValue, true)[app()->getLocale()] ?? '—';
                                    }
                                @endphp
                                <tr>
                                    <td>{{ $formattedKey }}</td>
                                    <td>{{ $oldValue }}</td>
                                    <td>{{ $newValue }}</td>
                                </tr>
                            @endforeach
                            @foreach(array_diff_key($newData, $oldData) as $key => $newValue)
                                @php
                                    $formattedKey = __("site.$key") ?? $key;
                                    if (is_array($newValue)) {
                                        $newValue = json_encode($newValue, JSON_UNESCAPED_UNICODE);
                                    }
                                @endphp
                                <tr>
                                    <td>{{ $formattedKey }}</td>
                                    <td>—</td>
                                    <td>{{ $newValue }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endforeach

