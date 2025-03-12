 <!--/ User Pills -->
 <div class="row text-nowrap  row-cols-1 row-cols-md-2">
    <div class="col mb-3">
        <div class="card h-100">
            <div class="card-body">
                <div class="card-icon mb-2">
                    <div class="avatar">
                        <div class="avatar-initial rounded bg-label-primary">
                            <i class="ti ti-currency-dollar ti-lg"></i>
                        </div>
                    </div>
                </div>
                <div class="card-info">
                    <h5 class="card-title mb-2">@lang("site.donation_money_pendding")</h5>
                    <div class="d-flex align-items-baseline gap-1">
                        <h5 class="text-primary mb-0">
                            {{$donationsPenddingTotalPrice}}@lang("site.egp")</h5>
                    </div>
                    <p class="mb-0 text-truncate">@lang("site.pendding_donation_price")</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col mb-3">
        <div class="card h-100">
            <div class="card-body">
                <div class="card-icon mb-2">
                    <div class="avatar">
                        <div class="avatar-initial rounded bg-label-primary">
                            <i class="ti ti-currency-dollar ti-lg"></i>
                        </div>
                    </div>
                </div>
                <div class="card-info">
                    <h5 class="card-title mb-2">@lang("site.donation_money_confirmed")</h5>
                    <div class="d-flex align-items-baseline gap-1">
                        <h5 class="text-primary mb-0">

                            {{$donationsConfirmTotalPrice}}@lang("site.egp")</h5>
                    </div>
                    <p class="mb-0 text-truncate">@lang("site.donation_money_confirmed")</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col mb-3">
        <div class="card h-100">
            <div class="card-body">
                <div class="card-icon mb-2">
                    <div class="avatar">
                        <div class="avatar-initial rounded bg-label-success">
                            <i class="ti ti-gift ti-lg"></i>
                        </div>
                    </div>
                </div>
                <div class="card-info">
                    <h5 class="card-title mb-2">@lang("site.donations")</h5>
                    <h5 class="text-success mb-0">{{$donations->count()}}</h5>

                    <p class="mb-0">@lang("site.total doners that donated to him")</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col mb-3">
        <div class="card h-100">
            <div class="card-body">
                <div class="card-icon mb-2">
                    <div class="avatar">
                        <div class="avatar-initial rounded bg-label-warning">
                            <i class="ti ti-star ti-lg"></i>
                        </div>
                    </div>
                </div>
                <div class="card-info">
                    <h5 class="card-title mb-2">@lang("site.tranfers")</h5>
                    <div class="d-flex align-items-baseline gap-1">
                        <h5 class="text-warning mb-0">{{$case->transfers->count()}}</h5>
                        <p class="mb-0">@lang("site.tranfers_count")</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col mb-3">
        <div class="card h-100">
            <div class="card-body">
                <div class="card-icon mb-2">
                    <div class="avatar">
                        <div class="avatar-initial rounded bg-label-warning">
                            <i class="ti ti-star ti-lg"></i>
                        </div>
                    </div>
                </div>
                <div class="card-info">
                    <h5 class="card-title mb-2">@lang("site.price")</h5>
                    <div class="d-flex align-items-baseline gap-1">
                        <h5 class="text-warning mb-0">{{$case->get_price()}}</h5>
                        <p class="mb-0">@lang("site.item that he need")</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col mb-3">
        <div class="card h-100">
            <div class="card-body">
                <div class="card-icon mb-2">
                    <div class="avatar">
                        <div class="avatar-initial rounded bg-label-warning">
                            <i class="ti ti-star ti-lg"></i>
                        </div>
                    </div>
                </div>
                <div class="card-info">
                    <h5 class="card-title mb-2">@lang("site.price_raised")</h5>
                    <div class="d-flex align-items-baseline gap-1">
                        <h5 class="text-warning mb-0">{{$case->get_price_raised()}}</h5>
                        <p class="mb-0">@lang("site.price_raised")</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<br>
