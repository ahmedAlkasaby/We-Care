<table class="datatable table border-top">
    <thead>
    <tr>
        <th class="text-sm">ID</div></th>
        <th class="text-sm-end">{{__("site.name")}}</div></th>
        <th class="text-nowrap text-sm-end">{{__("site.image")}}</th>
        <th class="text-nowrap text-sm-end">{{__("site.case")}}</th>
        <th class="text-nowrap text-sm-end">{{__("site.status")}}</th>
        <th class="text-lg-center">{{__("site.action")}}</th>
    </tr>
    </thead>
    <tbody>
    @if($sliders->isNotEmpty())
        @foreach ($sliders as $slider)
            <tr>
                <td class="text-sm">{{$loop->iteration}}</td>
                <td class="text-sm" style=""><div class="text-sm-end">{{ $slider->nameLang() }}</div></td>
                <td class="" style="">

                    <div class="h6 mb-0 text-sm-end">
                        <img src="{{ asset('../uploads/' . $slider->image) }}" alt="Slider Image" style="max-width: 100px; height: auto;">
                    </div>
                </td>
                <td class="text-nowrap text-sm-end" style=""><div class="h6 mb-0 text-sm-end">{{$slider->case_id ? $slider->case->user->name : null }}</div></td>

                {{-- status --}}
                <td class="text-center">
                    @if(  ! auth()->user()->hasPermission('sliders.toggle'))
                    <button disabled type="button" class="btn {{ $slider->active ? 'btn-success' : 'btn-danger' }} toggle-slider waves-effect waves-light" data-slider-id="{{ $slider->id }}" {{ Route::is('sliders.deleted') ? 'disabled' : '' }}>
                        <i class="fa-solid {{ $slider->active ? 'fa-check' : 'fa-circle-xmark' }}"></i>
                    </button>                    @else
                    <a href="{{ route('sliders.toggle', ['slider' => $slider->id]) }}">
                        <button  type="button" class="btn {{ $slider->active ? 'btn-success' : 'btn-danger' }} toggle-slider waves-effect waves-light" data-slider-id="{{ $slider->id }}" {{ Route::is('sliders.deleted') ? 'disabled' : '' }}>
                            <i class="fa-solid {{ $slider->active ? 'fa-check' : 'fa-circle-xmark' }}"></i>
                        </button>
                    </a>
                    @endif

                </td>

                {{-- Actions --}}
                <td class="text-lg-center" style="text-align: center; vertical-align: middle;">
                    <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="ti ti-dots-vertical"></i>
                        </button>
                        <div class="dropdown-menu">
                           @if (Route::is('sliders.index'))
                           @if (auth()->user()->hasPermission('sliders.update'))
                           <a class="dropdown-item" href="{{route("sliders.edit",["slider"=>$slider->id])}}"><i class="ti ti-pencil me-1"></i> {{__("site.edit")}}</a>
                           @endif
                           @if (auth()->user()->hasPermission('sliders.destroy'))
                           <button class="dropdown-item delete-btn" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $slider->id }}">
                               <i class="ti ti-trash me-1"></i> @lang('site.delete')
                           </button>
                           @endif
                           @endif
                           @if (Route::is('sliders.deleted'))
                           <a class="dropdown-item" href="{{route("sliders.restore",["slider"=>$slider->id])}}"> <i class="ti ti-pencil me-1"></i> @lang('site.restore')</a>
                           @endif
                        </div>
                    </div>
                </td>
            </tr>
            @include('admin.includes.modal.delete',["id"=>$slider->id,"main_name"=>"sliders","name"=>"slider"])

        @endforeach
    @else
    <tr>
        <td colspan="6" class="text-center">@lang('site.there_is_no_data')</td>
    </tr>

    @endif
    </tbody>
</table>
<div class="m-2">
    {{ $sliders->links() }}
</div>
