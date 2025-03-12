<div class="modal fade" id="itemModal{{ $donation->id }}" tabindex="-1" aria-labelledby="itemModalLabel{{ $donation->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="itemModalLabel{{ $donation->id }}">@lang('site.items')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="list-group">
                    @foreach ($donation->items as $item)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $item->namelang() }}
                            <span class="badge bg-primary rounded-pill">{{ $item->pivot->amount }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('site.close')</button>
            </div>
        </div>
    </div>
</div>