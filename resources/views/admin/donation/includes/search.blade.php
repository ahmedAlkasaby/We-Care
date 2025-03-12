<div class="card-header d-flex flex-wrap py-0 flex-column flex-sm-row justify-content-between mt-4 mb-4">
    @if($title??false)
    <h5 class="card-title m-0">@lang('site.donation_details')</h5>
    @endif
    @if (! Route::is('cases.show'))
    <div class="me-5 ms-n2 pe-5">
        <div class="dataTables_filter">
            <form action="{{ route('donations.index') }}" method="get" class="d-flex align-doners-center">
                    @if (! Route::is('cases.show'))
                    <button data-bs-toggle="modal" data-bs-target="#donationFilter" class="btn btn-primary add-new btn-secandary ms-2 waves-effect waves-light" type="button" >
                        <span>
                            <i class="ti ti-filter me-0 me-sm-1"></i>
                            <span class="d-none d-sm-inline-block">@lang('site.filterr')</span>
                        </span>
                    </button>
                    @endif
                </button>
            </form>
        </div>
    </div>
    @endif
    <div class="d-flex justify-content-end">
        @if (auth()->user()->hasPermission('donations.store'))
        <button {{  Route::is('cases.show') ? $case->this_case_need() ? '': 'disabled' :''  }} class="btn btn-secondary add-new btn-primary ms-2 waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#donation">
            <span>
                <i class="ti ti-plus me-0 me-sm-1 ti-xs"></i>
                <span class="d-none d-sm-inline-block">{{ Route::is('cases.show') ? __('site.create_donation_for_this_case') : __('site.create_donation') }}</span>
            </span>
        </button>
        @else
        <button class="btn btn-secondary add-new btn-primary ms-2 waves-effect waves-light" disabled>
            <span>
                <i class="ti ti-plus me-0 me-sm-1 ti-xs"></i>
                <span class="d-none d-sm-inline-block">@lang('site.add_donations')</span>
            </span>
        </button>
        @endif
    </div>
</div>

