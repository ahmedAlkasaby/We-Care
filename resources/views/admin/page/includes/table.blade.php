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
        @if($pages->isNotEmpty())
        @foreach ($pages as $page)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td class="text-lg-center">{{ $page->nameLang() }}</td>
            <td class="text-lg-center">
                <a href="{{ route('pages.toggle',['page'=>$page->id]) }}">
                    <button type="button" class="btn {{ $page->active ? 'btn-success' : 'btn-danger' }} toggle-case waves-effect waves-light" data-case-id="{{ $page->id }}">
                        <i class="fa-solid {{ $page->active ? 'fa-check' : 'fa-circle-xmark' }}"></i>
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
                        @if (auth()->user()->hasPermission('pages.update'))
                        <a class="dropdown-item" href="{{route("pages.edit",["page"=>$page->id])}}"><i
                                class="ti ti-pencil me-1"></i> @lang('site.edit')</a>
                        @else
                        <button disabled class="dropdown-item"><i class="ti ti-pencil me-1"></i>
                            @lang('site.edit')</button>
                        @endif
                        @if (auth()->user()->hasPermission('pages.destroy'))
                        <button class="dropdown-item delete-btn" data-bs-toggle="modal"
                            data-bs-target="#deleteModal{{ $page->id }}">
                            <i class="ti ti-trash me-1"></i> @lang('site.delete')
                        </button>
                        @else
                        <button class="dropdown-item" disabled>
                            <i class="ti ti-trash me-1"></i> @lang('site.delete')
                        </button>
                        @endif
                    </div>
                </div>
            </td>
        </tr>
        @include('admin.includes.modal.delete',["id"=>$page->id,"main_name"=>"pages","name"=>"page"])
        @endforeach
        @else
        <tr>
            <td colspan="7" class="text-center">@lang('site.there_is_no_data')</td>
        </tr>
        @endif
    </tbody>
</table>
<div class="m-2">
    {{ $pages->links() }}
</div>
