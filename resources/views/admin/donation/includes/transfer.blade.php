<div class="modal fade items-modal" id="donationTransferItems_{{ $donation->id }}" data-id="{{ $donation->id }}"
    tabindex="-1" aria-labelledby="donationTransferItemsLabel" aria-hidden="true">
    <form action="{{ route('transfers.store') }}" method="post">
        @csrf
        <input type="hidden" name="case_id" value="{{ $donation->case->id }}">
        <input type="hidden" name="donation_id" value="{{ $donation->id }}">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header pb-2">
                    <h1 class="modal-title fs-5" id="caseFilterLabel">@lang('site.transfer')</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        style="position: relative;"></button>
                </div>
                <div class="modal-body border-top">
                    @if ($donation->case->items->count()>0)
                    <h3>@lang('site.donation_price') = </h3>
                    <h2 class="donation-price"
                        data-initial-donation="{{ $donation->price - $donation->doner_price }}">
                        {{ $donation->price - $donation->doner_price }}</h2>
                    <h5>@lang('site.items')</h5>
                    <div class="table-responsive text-nowrap">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th>@lang('site.item')</th>
                                    <th>@lang('site.item_price')</th>
                                    <th>@lang('site.case_need')</th>
                                    <th>@lang('site.in_stock')</th>
                                    <th>@lang('site.amount')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($donation->case->items as $item)
                                <input type="hidden" value="items[{{ $item->id }}]">

                                <tr data-in-stock="{{ $item->amount }}" data-item-price="{{ $item->price }}">
                                    <td>{{ $item->nameLang() }}</td>
                                    <td class="item-price">{{ $item->price }}</td>
                                    <td>{{ ($item->pivot->amount - $item->pivot->amount_raised) }}</td>
                                    <td class="in-stock">{{ $item->amount }}</td>
                                    <td>
                                        <input class="form-control" type="number" name="items[{{ $item->id }}][amount]"
                                            value="0" min="0">
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('site.close')</button>
                    <button type="submit" class="btn btn-primary">@lang('site.transfer')</button>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="modal fade  money-modal" id="donationTransferPrice_{{ $donation->id }}" data-id="{{ $donation->id }}"
    tabindex="-1" aria-labelledby="donationTransferPriceLabel" aria-hidden="true">
    <form action="{{ route('transfers.store') }}" method="post">
        @csrf
        <input type="hidden" name="case_id" value="{{ $donation->case->id }}">
        <input type="hidden" name="donation_id" value="{{ $donation->id }}">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="caseFilterLabel">@lang('site.transfer')</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body border-top">

                    <h5>@lang('site.price')</h5>
                    <h2 class="donation-price"
                    data-initial-donation="{{ $donation->price - $donation->doner_price }}">
                    {{ $donation->price - $donation->doner_price }}</h2>
                    <div class="table-responsive text-nowrap">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th>@lang('site.case_need')</th>
                                    <th>@lang('site.in_storage')</th>
                                    <th>@lang('site.amount')</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $donation->case->price - $donation->case->price_raised }}</td>
                                    <td class="storage-price" data-storage="{{ $storage->price }}">{{ $storage->price }}
                                    </td>
                                    <td>
                                        <input class="form-control price-input" type="number" step="0.5" name="price"
                                            value="0" data-in-stock="{{ $storage->price }}" min="0">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('site.close')</button>
                    <button type="submit" class="btn btn-primary">@lang('site.transfer')</button>
                </div>
            </div>
        </div>
    </form>
</div>
