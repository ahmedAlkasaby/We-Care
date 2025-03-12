<div class="card-datatable table-responsive">
    @include('admin.impact.includes.filter')
  <table class="datatable table border-top">
      <thead>
          <tr>
              <th>
                  <div class="text-sm">ID</div>
              </th>
              <th>
                  <div class="text-lg-center">{{__("site.name")}}</div>
              </th>
              <th class="text-lg-center">{{__("site.case")}}</th>
              <th class="text-lg-center">{{__("site.active")}}</th>
              <th class="text-lg-center">{{__("site.action")}}</th>
          </tr>
      </thead>
      <tbody>
          @if($impacts->isNotEmpty())
          @foreach ($impacts as $impact)
          <tr>
              <td>{{$loop->iteration}}</td>
              <td class="text-lg-center">{{ $impact->nameLang() }}</td>
              <td class="text-lg-center">{{$impact->case->user->name??null}}</td>
              <td class="text-lg-center">
                  <a href="{{ route('impacts.toggle',['impact'=>$impact->id]) }}">
                      <button type="button" class="btn {{ $impact->active ? 'btn-success' : 'btn-danger' }} toggle-case waves-effect waves-light" data-case-id="{{ $impact->id }}">
                          <i class="fa-solid {{ $impact->active ? 'fa-check' : 'fa-circle-xmark' }}"></i>
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
                          @if (auth()->user()->hasPermission('impacts.update'))
                          <a class="dropdown-item" href="{{route("impacts.edit",["impact"=>$impact->id])}}"><i
                                  class="ti ti-pencil me-1"></i> @lang('site.edit')</a>
                          @endif
                           @if (auth()->user()->hasPermission('impacts.destroy'))
                          <button class="dropdown-item delete-btn" data-bs-toggle="modal"
                              data-bs-target="#deleteModal{{ $impact->id }}">
                              <i class="ti ti-trash me-1"></i> @lang('site.delete')
                          </button>
                          @endif
                      </div>
                  </div>
              </td>
          </tr>
          @include('admin.includes.modal.delete',["id"=>$impact->id,"main_name"=>"impacts","name"=>"impact"])
          @endforeach
          @else
          <tr>
              <td colspan="7" class="text-center">@lang('site.there_is_no_data')</td>
          </tr>
          @endif
      </tbody>
  </table>
  <div class="m-2">
      {{ $impacts->links() }}
  </div>
</div>
