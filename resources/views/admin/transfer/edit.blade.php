<div class="modal fade" id="caseTransfer_{{ $transfer->case_id }}" tabindex="-1" aria-labelledby="caseTransferLabel"
  aria-hidden="true">
  {!! Form::open(['route' => ['transfers.update', $transfer->id], 'method' => 'PUT']) !!}

  <input type="hidden" name="case_id" value="{{ $transfer->charityCase }}">


  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="caseFilterLabel">@lang('site.transfer')</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body border-top">
        @if ($transfer->charityCase->items->count()>0)
        <h5>@lang('site.items')</h5>
        <div class="table-responsive text-nowrap">
          <table class="table table-borderless">
            <thead>
              <tr>
                <th>@lang('site.item')</th>
                <th>@lang('site.case_need')</th>
                <th>@lang('site.in_stock')</th>
                <th>@lang('site.amount')</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($transfer->charityCase->items as $item)
              <input type="hidden" value="items[{{ $item->id }}]">
              <tr>
                <td>{{ $item->nameLang() }}</td>
                <td>{{ ($item->pivot->amount - $item->pivot->amount_raised) }}</td>
                <td class="in-stock">{{ $item->amount }}</td>
                <td>
                  <input class="form-control" type="number" step="0.01" name="items[{{ $item->id }}][amount]" value="0">
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        @else
        <h5>@lang('site.items')</h5>
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
              <td>{{ $transfer->charityCase->price - $transfer->charityCase->price_raised }}</td>
              <td class="storage-price">{{ $storage->price }}</td>
              <td>
                <input class="form-control price-input" type="number" step="0.01" name="price" value="0">
              </td>
            </tbody>
          </table>
        </div>
        @endif
      </div>
      @include('admin.includes.form.submit-discard')

    </div>
  </div>





  {!! Form::close() !!}
</div>