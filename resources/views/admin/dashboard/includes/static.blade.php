<div class="row mb-2 g-6">

    <div class="col-lg-3 col-sm-6 mb-4">
        <div class="card card-border-shadow-primary h-100">
            <div class="card-body">
                <div class="d-flex align-items-center mb-2">
                    <div class="avatar me-4">
                        <span class="avatar-initial rounded bg-label-primary"><i
                                class="ti ti-truck ti-28px"></i></span>
                    </div>
                    <h4 class="mb-0">{{$urgent_cases->count()}}</h4>
                </div>
                <p class="mb-1">{{__('site.urgent cases')}}</p>
                <p class="mb-0">
                    @if($urgent_cases->count() > 0)
                    <a href="{{route('cases.index',['active'=>1,'priority'=>'high'])}}"><span
                            class="btn btn-primary mb-2 text-nowrap add-new-role">{{__('site.details')}}</span></a>
                    @else
                    <span class="btn btn-primary mb-2 text-nowrap add-new-role disabled"
                        >{{__('site.details')}}</span>
                    @endif
                </p>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-sm-6 mb-4">
        <div class="card card-border-shadow-warning h-100">
            <div class="card-body">
                <div class="d-flex align-items-center mb-2">
                    <div class="avatar me-4">
                        <span class="avatar-initial rounded bg-label-warning"><i
                                class="ti ti-alert-triangle ti-28px"></i></span>
                    </div>
                    <h4 class="mb-0">{{$total_cases_need->count()}}</h4>
                </div>
                <p class="mb-1">{{__('site.Total cases that need support')}}</p>
                <p class="mb-0">
                    @if($total_cases_need->count() > 0)
                    <a href="{{route('cases.index',['active'=>1])}}"><span
                            class="btn btn-primary mb-2 text-nowrap add-new-role">{{__('site.details')}}</span></a>
                    @else
                    <span class="btn btn-primary mb-2 text-nowrap add-new-role disabled"
                        >{{__('site.details')}}</span>
                    @endif
                </p>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-sm-6 mb-4">
        <div class="card card-border-shadow-danger h-100">
            <div class="card-body">
                <div class="d-flex align-items-center mb-2">
                    <div class="avatar me-4">
                        <span class="avatar-initial rounded bg-label-danger"><i
                                class="ti ti-git-fork ti-28px"></i></span>
                    </div>
                    <h4 class="mb-0">{{$total_cases->count()}}</h4>
                </div>
                <p class="mb-1">{{__('site.total cases')}}</p>
                <p class="mb-0">
                    @if($total_cases->count() > 0)
                    <a href="{{route('cases.index')}}"><span
                            class="btn btn-primary mb-2 text-nowrap add-new-role">{{__('site.details')}}</span></a>
                    @else
                    <span class="btn btn-primary mb-2 text-nowrap add-new-role disabled"
                        >{{__('site.details')}}</span>
                    @endif
                </p>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-sm-6 mb-4">
        <div class="card card-border-shadow-info h-100">
            <div class="card-body">
                <div class="d-flex align-items-center mb-2">
                    <div class="avatar me-4">
                        <span class="avatar-initial rounded bg-label-info"><i
                                class="ti ti-clock ti-28px"></i></span>
                    </div>
                    <h4 class="mb-0">{{$repeating_cases->count()}}</h4>
                </div>
                <p class="mb-1">@lang("site.repeating cases")</p>
                <p class="mb-0">
                    @if($repeating_cases->count() > 0)
                    <a href="{{route('cases.index',['active'=>1,'is_repeated'=>'none'])}}"><span
                            class="btn btn-primary mb-2 text-nowrap add-new-role">{{__('site.details')}}</span></a>
                    @else
                    <span class="btn btn-primary mb-2 text-nowrap add-new-role disabled"
                        >{{__('site.details')}}</span>
                    @endif
                </p>
            </div>
        </div>
    </div>
</div>
