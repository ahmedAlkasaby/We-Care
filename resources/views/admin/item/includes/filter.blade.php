<div class="card-header d-flex flex-wrap py-0 flex-column flex-sm-row justify-content-between mt-4 mb-4">
    <div class="me-5 ms-n2 pe-5">
        <div class="dataTables_filter">
            <form action="{{ route('items.index') }}" method="get" class="d-flex align-items-center">
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
    @if (auth()->user()->hasPermission('doners.store'))
    <div class="d-flex justify-content-end">
        <button  type="button" class="btn btn-primary add-new" data-bs-toggle="modal" data-bs-target="#itemsForm">
            <span>
                <i class="ti ti-plus me-0 me-sm-1 ti-xs"></i>
                <span class="d-none d-sm-inline-block">@lang('site.add_item')</span>
            </span>
        </button>
    </div>
    @else
        <div class="d-flex justify-content-end">
            <button disabled class="btn btn-secondary add-new btn-primary ms-2 waves-effect waves-light">
                <span>
                    <i class="ti ti-plus me-0 me-sm-1 ti-xs"></i>
                    <span class="d-none d-sm-inline-block">@lang('site.add_item')</span>
                </span>
            </button>
        </div>
    @endif

</div>
