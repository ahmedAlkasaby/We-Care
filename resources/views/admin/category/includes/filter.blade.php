<div class="card-header d-flex flex-wrap py-0 flex-column flex-sm-row justify-content-between mt-4 mb-4">
    <div class="me-5 ms-n2 pe-5">
        <div class="dataTables_filter">
            <form action="{{ route('categories.index') }}" method="get" class="d-flex align-items-center">
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
    <div class="d-flex justify-content-end">
        @if (auth()->user()->hasPermission('categories.store'))
        <button class="btn btn-secondary add-new btn-primary ms-2 waves-effect waves-light" data-bs-toggle="modal"
         data-bs-target="#categoriesForm">
            <span>
                <i class="ti ti-plus me-0 me-sm-1 ti-xs"></i>
                <span class="d-none d-sm-inline-block">@lang('site.add_category')</span>
            </span>
        </button>
        @else
        <div class="d-flex justify-content-end">
            <button disabled class="btn btn-secondary add-new btn-primary ms-2 waves-effect waves-light">
                <span>
                    <i class="ti ti-plus me-0 me-sm-1 ti-xs"></i>
                    <span class="d-none d-sm-inline-block">@lang('site.add_category')</span>
                </span>
            </button>
        </div>
        @endif
    </div>
</div>
