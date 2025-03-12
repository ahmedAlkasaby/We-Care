<div class="modal fade" id="item-show" tabindex="-1" aria-labelledby="donationLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content p-3 p-md-4">
            <div class="modal-header py-4">
                <h5 class="modal-title" id="donationLabel">@lang('site.items')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body border-top">
                <table class="datatable table border-top">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th class="text-nowrap text-sm-center">@lang('site.name')</th>
                            <th class="text-nowrap text-sm-center">@lang('site.amount')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($donations->items() as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="text-nowrap text-sm-center">{{ $item->nameLang()}}</td>
                            <td class="text-nowrap text-sm-center">{{ $item->amount}}</td>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
