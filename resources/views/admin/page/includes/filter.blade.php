<div class="card-header d-flex flex-wrap py-0 flex-column flex-sm-row justify-content-between mt-4 mb-4">
    <div class="me-5 ms-n2 pe-5">
        <div class="dataTables_filter">
            @if(Route::is("pages.index"))
            <form action="{{ route('pages.index') }}" method="get" class="d-flex align-items-center">
                @else
                <form action="{{ route('pages.deleted') }}" method="get" class="d-flex align-items-center">
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
        <div class="d-flex justify-content-end">
            @if (auth()->user()->hasPermission('pages.store'))
            <a href="{{ route('pages.create') }}" class="btn btn-primary">
                <span>
                    <i class="ti ti-plus me-0 me-sm-1 ti-xs"></i>
                    <span class="d-none d-sm-inline-block">@lang('site.add_page')</span>
                </span>
            </a>
            @else
            <button disabled class="btn btn-secondary add-new btn-primary ms-2 waves-effect waves-light">
                <span>
                    <i class="ti ti-plus me-0 me-sm-1 ti-xs"></i>
                    <span class="d-none d-sm-inline-block">@lang('site.add_impact')</span>
                </span>
            </button>
            @endif
        </div>

    @if(Route::is("pages.index"))
    @if (auth()->user()->hasPermission('pages.destroy'))
        <a href="{{ route('pages.deleted') }}" class="btn btn-secondary ms-2">
            <span>
                <i class="ti ti-plus me-0 me-sm-1 ti-xs"></i>
                <span class="d-none d-sm-inline-block">@lang('site.deleted_list')</span>
            </span>
        </a>
        @endif
        @else
        <a href="{{ route('pages.index') }}" class="btn btn-secondary ms-2">
            <span>
                <i class="ti ti-plus me-0 me-sm-1 ti-xs"></i>
                <span class="d-none d-sm-inline-block">@lang('site.list')</span>
            </span>
        </a>
        @endif
    </div>
    </div>
</div>
