<div class="card-header d-flex flex-wrap py-0 flex-column flex-sm-row justify-content-between mt-4 mb-4">
    <div class="me-5 ms-n2 pe-5">
        <div class="dataTables_filter">
            @if(Route::is("faqs.index"))
            <form action="{{ route('faqs.index') }}" method="get" class="d-flex align-items-center">
            @else
            <form action="{{ route('faqs.deleted') }}" method="get" class="d-flex align-items-center">
            @endif
                <input type="search" name="search" class="form-control me-2" placeholder="@lang('site.filter')"
                    aria-controls="DataTables_Table_0" value="{{ request('search') }}" style="flex: 1;">
                <button type="submit" class="btn btn-primary" style="flex-shrink: 0;">
                    <span>
                        <i class="ti ti-filter me-0 me-sm-1"></i>
                        <span class="d-none d-sm-inline-block">@lang('site.filter')</span>
                    </span>
                </button>
            </form>
        </div>
    </div>
    <div class="d-flex justify-content-end space-x-2">
        @if(auth()->user()->hasPermission('faqs.store'))
        <a href="{{ route('faqs.create') }}" class="btn btn-primary">
            <span>
                <i class="ti ti-plus me-0 me-sm-1 ti-xs"></i>
                <span class="d-none d-sm-inline-block">@lang('site.add_faq')</span>
            </span>
        </a>
        @else
        <a href="#" class="btn btn-primary" disabled>
            <span>
                <i class="ti ti-plus me-0 me-sm-1 ti-xs"></i>
                <span class="d-none d-sm-inline-block">@lang('site.add_faq')</span>
            </span>
        </a>
        @endif
        @if(Route::is("faqs.index"))
        @if(auth()->user()->hasPermission('faqs.destroy'))
        <a href="{{ route('faqs.deleted') }}" class="btn btn-secondary ms-2">
            <span>
                <i class="ti ti-plus me-0 me-sm-1 ti-xs"></i>
                <span class="d-none d-sm-inline-block">@lang('site.deleted_list')</span>
            </span>
        </a>
        @else
        <a href="{{ route('faqs.index') }}" class="btn btn-secondary ms-2">
            <span>
                <i class="ti ti-plus me-0 me-sm-1 ti-xs"></i>
                <span class="d-none d-sm-inline-block">@lang('site.list')</span>
            </span>
        </a>
        @endif
        @endif
    </div>
</div>

</div>
