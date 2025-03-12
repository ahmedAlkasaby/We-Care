<div class="modal fade" id="donation" tabindex="-1" aria-labelledby="donationLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content p-3 p-md-4">
            <div class="modal-header">
                <h5 class="modal-title" id="donationLabel">@lang('site.add_donation')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body border-top">
                {!! Form::open(['route' => 'donations.store', 'method' => 'POST', 'id' => 'storeDonation', 'class' => 'row g-3', 'enctype' => 'multipart/form-data']) !!}

                <div class="col-12 col-md-12">
                    @include('admin.includes.form.select', [
                        'label' => __('site.doner'),
                        'options' => $doners->mapWithKeys(function($doner) {
                            return [$doner->id => __('site.name') . ' : ' . $doner->name ];
                        }),
                        'fieldName' => 'doner_id',
                        'fieldValue' => old('doner_id') ?? null,
                        'class' => 'form-select',
                    ])
                </div>

                @if (Route::is('cases.show'))
                <input name="case_id" type="hidden" value="{{ $case->id }}">
                @endif

                <!-- Section to choose donation type -->
                <div class="col-12 text-center mb-3">
                    <button type="button" class="btn btn-outline-primary" id="donateMoney">@lang('site.donate_money')</button>
                    <button type="button" class="btn btn-outline-primary" id="donateItems">@lang('site.donate_items')</button>
                </div>

                <!-- Money donation section -->
                <div id="moneyDonationSection" class="col-12 col-md-12" style="display: none;">
                    <label class="form-label">@lang('site.price')</label>
                    <input type="number" name="price" class="form-control" placeholder="@lang('site.enter_amount')" min="0" />
                </div>

                <!-- Items donation section -->
                @if (Route::is('cases.show'))
                @include('admin.donation.includes.create_donation_in_case')
                @else
                @include('admin.donation.includes.create_donation')
                @endif
                @include('admin.includes.form.submit-discard')

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
