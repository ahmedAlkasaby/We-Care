<div class="modal fade case-transfer-modal" id="caseTransfer_{{ $case->id }}" tabindex="-1" aria-labelledby="caseTransferLabel"
    aria-hidden="true">
    <form action="{{ route('transfers.store') }}" method="post">
        @csrf
        <input type="hidden" name="case_id" value="{{ $case->id }}">

        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header py-3">
                    <h1 class="modal-title fs-5" id="caseFilterLabel">@lang('site.transfer')</h1>
                    <button style="position: relative;" type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body border-top">
                    @if ($case->items->count()>0)
                    <h5>@lang('site.items')</h5>
                    <div class="table-responsive text-nowrap">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th>@lang('site.item')</th>
                                    <th>@lang('site.case_need')</th>
                                    <th>@lang('site.unit_price')</th>
                                    <th>@lang('site.in_stock')</th>
                                    <th>@lang('site.amount')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($case->items as $item)
                                <input type="hidden" value="items[{{ $item->id }}]">
                                <tr>
                                    <td>{{ $item->nameLang() }}</td>
                                    <td class="case_need_item">{{ ($item->pivot->amount - $item->pivot->amount_raised)
                                        }}</td>
                                    <td>{{ $item->price }}</td>
                                    <td class="in-stock">{{ $item->amount }}</td>
                                    <td>
                                        <input class="form-control item-amount" type="number" step="1"
                                        name="items[{{ $item->id }}][amount]" value="0">

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <h5>@lang('site.price')</h5>
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
                                <td class="case_need_price">{{ $case->get_price() - $case->get_price_raised() }}</td>
                                <td class="storage-price">{{ $storage->price }}</td>
                                <td>
                                    <input class="form-control price-input" type="number" step="0.01" name="price"
                                        value="0">
                                </td>
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
