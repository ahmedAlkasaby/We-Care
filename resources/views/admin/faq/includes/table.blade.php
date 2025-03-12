<table class="datatable table border-top">
    <thead>
        <tr>
            <th>
                <div class="text-sm">ID</div>
            </th>

            <th class="text-lg-center">{{__("site.name")}}</th>
            <th class="text-lg-center">{{__("site.active")}}</th>
            <th class="text-lg-center">{{__("site.action")}}</th>
        </tr>
    </thead>
    <tbody>
        @if($faqs->isNotEmpty())
        @foreach ($faqs as $faq)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td class="text-lg-center">{{ $faq->nameLang() }}</td>
            <td class="text-lg-center">
                <a href="{{ route('faqs.toggle',['faq'=>$faq->id]) }}">
                    <button type="button" class="btn {{ $faq->active ? 'btn-success' : 'btn-danger' }} toggle-case waves-effect waves-light" data-case-id="{{ $faq->id }}">
                        <i class="fa-solid {{ $faq->active ? 'fa-check' : 'fa-circle-xmark' }}"></i>
                    </button>
                </a>
            </td>

            <td class="text-lg-center" style="text-align: center; vertical-align: middle;">
                <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                        data-bs-toggle="dropdown">
                        <i class="ti ti-dots-vertical"></i>
                    </button>
                    <div class="dropdown-menu">
                        @if (auth()->user()->hasPermission('faqs.update'))
                        <a class="dropdown-item" href="{{route("faqs.edit",["faq"=>$faq->id])}}"><i
                                class="ti ti-pencil me-1"></i> @lang('site.edit')</a>
                        @endif
                        @if (auth()->user()->hasPermission('faqs.destroy'))
                        <button class="dropdown-item delete-btn" data-bs-toggle="modal"
                            data-bs-target="#deleteModal{{ $faq->id }}">
                            <i class="ti ti-trash me-1"></i> @lang('site.delete')
                        </button>
                        @endif
                    </div>
                </div>
            </td>
        </tr>
        @include('admin.includes.modal.delete',["id"=>$faq->id,"main_name"=>"faqs","name"=>"faq"])
        @endforeach
        @else
        <tr>
            <td colspan="7" class="text-center">@lang('site.there_is_no_data')</td>
        </tr>
        @endif
    </tbody>
</table>
<div class="m-2">
    {{ $faqs->links() }}
</div>
