<div class="row">
    <div class="col-lg-3 col-sm-6 mb-4">
        <div class="card card-border-shadow-primary h-100">
            <div class="card-body">
                <div class="d-flex align-items-center mb-2">
                    <div class="avatar me-4">
                        <span class="avatar-initial rounded bg-label-primary">
                            <i class="ti ti-truck ti-28px"></i>
                        </span>
                    </div>
                    <h4 id="case-that-need-price-count" class="mb-0">{{$case_that_need_price->count()}}</h4>
                </div>
                <p class="mb-1">{{__('site.case_that_need_price')}}</p>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-sm-6 mb-4">
        <div class="card card-border-shadow-warning h-100">
            <div class="card-body">
                <div class="d-flex align-items-center mb-2">
                    <div class="avatar me-4">
                        <span class="avatar-initial rounded bg-label-warning">
                            <i class="ti ti-alert-triangle ti-28px"></i>
                        </span>
                    </div>
                    <h4 id="case-that-need-items-count" class="mb-0">{{$case_that_need_items->count()}}</h4>
                </div>
                <p class="mb-1">{{__('site.case_that_need_items')}}</p>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-sm-6 mb-4">
        <div class="card card-border-shadow-danger h-100">
            <div class="card-body">
                <div class="d-flex align-items-center mb-2">
                    <div class="avatar me-4">
                        <span class="avatar-initial rounded bg-label-danger">
                            <i class="ti ti-git-fork ti-28px"></i>
                        </span>
                    </div>
                    <h4 id="total-price-for-case-that-need-items" class="mb-0">{{$total_price_for_case_that_need_items}} @lang("site.egp")</h4>
                </div>
                <p class="mb-1">{{__('site.total_price_for_case_that_need_items')}} </p>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-sm-6 mb-4">
        <div class="card card-border-shadow-info h-100">
            <div class="card-body">
                <div class="d-flex align-items-center mb-2">
                    <div class="avatar me-4">
                        <span class="avatar-initial rounded bg-label-info">
                            <i class="ti ti-clock ti-28px"></i>
                        </span>
                    </div>
                    <h4 id="total-price-for-case-that-need-price" class="mb-0">{{$total_price_for_case_that_need_price}} @lang("site.egp")</h4>
                </div>
                <p class="mb-1">{{__('site.total_price_for_case_that_need_price')}}</p>
            </div>
        </div>
    </div>
</div>
