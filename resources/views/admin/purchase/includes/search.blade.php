<div class="card-header d-flex flex-wrap py-0 flex-column flex-sm-row justify-content-between mt-4 mb-4">
    <div class="me-5 ms-n2 pe-5">
        <div class="dataTables_filter">
            <form action="{{ route('purchases.index') }}" method="get" class="d-flex align-doners-center">
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
        {{-- <button data-bs-toggle="modal" data-bs-target="#donationFilter" class="btn btn-secondary add-new btn-secandary ms-2 waves-effect waves-light" type="button" >
            <span><i class="ti ti-file-export me-sm-1"></i> <span class="d-none d-sm-inline-block">@lang('site.filters')</span></span>
        </button> --}}
        @if (auth()->user()->hasPermission('purchases.store'))

        <button class="btn btn-secondary add-new btn-primary ms-2 waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#purchase">
            <span>
                <i class="ti ti-plus me-0 me-sm-1 ti-xs"></i>
                <span class="d-none d-sm-inline-block">@lang('site.add_purchase')</span>
            </span>
        </button>
        @else
        <button class="btn btn-secondary add-new btn-primary ms-2 waves-effect waves-light" disabled>
            <span>
                <i class="ti ti-plus me-0 me-sm-1 ti-xs"></i>
                <span class="d-none d-sm-inline-block">@lang('site.add_purchase')</span>
            </span>
        </button>
        @endif
    </div>
</div>

