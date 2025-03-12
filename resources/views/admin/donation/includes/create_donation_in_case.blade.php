<div id="itemsDonationSection" style="display: none;">
    @if ($case->items->count() > 0)
    <div class="table-responsive text-nowrap">
        <table class="table table-borderless">
            <thead>
                <tr>
                    <th>@lang('site.item')</th>
                    <th>@lang('site.case_need')</th>
                    <th>@lang('site.amount')</th>
                </tr>
            </thead>
            <tbody>
                @php $i = 0; @endphp
                @foreach ($case->items as $item)
                <tr>
                    <td>{{ $item->nameLang() }}</td>
                    <td>{{ $item->pivot->amount - $item->pivot->amount_raised }}</td>
                    <input type="hidden" name="items[{{ $i }}][item_id]" value="{{ $item->id }}">
                    <td>
                        <input class="form-control" type="number" name="items[{{ $i }}][amount]" value="0" min="0">
                    </td>
                </tr>
                @php $i++; @endphp
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <h2>@lang('site.not_found_items')</h2>
    @endif
</div>

