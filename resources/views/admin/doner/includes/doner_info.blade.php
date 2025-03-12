<div class="card mb-6">
    <div class="card-body pt-12">
      <div class="user-avatar-section">
        <div class=" d-flex align-items-center flex-column">
          @if(!$doner->image)

          <img class="img-fluid rounded mb-4" src="{{asset(" admin/assets/img/avatars/1.png")}}" height="120"
            width="120" alt="User avatar">
          @else
          <img class="img-fluid rounded mb-4" src="{{ asset('uploads/' . $doner->image)}}" height="120"
            width="120" alt="User avatar">
          @endif
          <div class="user-info text-center">
            <h5>{{$doner->name}}</h5>
            <span class="badge bg-label-secondary">{{$doner->role}}</span>
          </div>
        </div>
        <br>
      </div>

      <h5 class="pb-4 border-bottom mb-4">@lang("site.details")</h5>
      <div class="info-container">
        <ul class="list-unstyled mb-6">
          <li class="mb-2">
            <span class="h6">@lang("site.name"):</span>
            <span>{{$doner->name}}</span>
          </li>
          <li class="mb-2">
            <span class="h6">@lang("site.phone"):</span>
            <span>{{$doner->phone ?? null}}</span>
          </li>
          <li class="mb-2">
            <span class="h6">@lang("site.role"):</span>
            <span>{{$doner->role}}</span>
          </li>
          <li class="mb-2">
            <span class="h6">@lang("site.email"):</span>
            <span>{{$doner->email ?? null}}</span>
          </li>
          <li class="mb-2">
            <span class="h6">@lang("site.city"):</span>
            <span>{{$city ?? null}}</span>
          </li>
          <li class="mb-2">
            <span class="h6">@lang("site.region"):</span>
            <span>{{$region ?? null}}</span>
          </li>
        </ul>
        <div class="d-flex justify-content-center">

          @if (auth()->user()->hasPermission('doners.update'))
          <a class=" edit-btn btn btn-primary w-100 waves-effect waves-light" href="#" data-bs-toggle="modal"
            data-bs-target="#donersForm">
            <i class="ti ti-pencil me-1"></i> @lang('site.Edit')
          </a>
          @endif
        </div>
      </div>
    </div>
  </div>
