<div class="card mb-4">
    <div class="card-header">
        <h5 class="text-primary">@lang("site.details")</h5>
    </div>
    <div class="card-body">
        <div class="row g-4">
            <!-- Title -->
            <div class="col-md-6">
                <label class="form-label fw-bold">@lang("site.title")</label>
                <p class="text-muted">{{$case->namelang()}}</p>
            </div>

            <!-- Volunteer -->
            <div class="col-md-6">
                <label class="form-label fw-bold">@lang("site.voulnter")</label>
                <p class="text-muted">{{$voulnteer->name ?? null}}</p>
            </div>

            <!-- Category -->
            <div class="col-md-6">
                <label class="form-label fw-bold">@lang("site.category_case")</label>
                <p class="text-muted">{{$category->namelang()}}</p>
            </div>

            <!-- Priority -->
            <div class="col-md-6">
                <label class="form-label fw-bold">@lang("site.priority")</label>
                <p class="text-muted">{{$case->priority}}</p>
            </div>

            <!-- Repeating -->
            <div class="col-md-6">
                <label class="form-label fw-bold">@lang("site.repeating")</label>
                <p class="text-muted">{{$case->repeating ?? __("site.null")}}</p>
            </div>

            <!-- Next Donation Date -->
            <div class="col-md-6">
                <label class="form-label fw-bold">@lang("site.next_donation_date")</label>
                <p class="text-muted">{{$case->next_donation_date ?? __("site.null")}}</p>
            </div>

            <!-- Price -->
            <div class="col-md-6">
                <label class="form-label fw-bold">@lang("site.price")</label>
                <p class="text-muted">{{$case->get_price() ?? __("site.null")}}</p>
            </div>

            <!-- Price Raised -->
            <div class="col-md-6">
                <label class="form-label fw-bold">@lang("site.price_raised")</label>
                <p class="text-muted">{{$case->get_price_raised() ?? __("site.null")}}</p>
            </div>

            <!-- Date Start -->
            <div class="col-md-6">
                <label class="form-label fw-bold">@lang("site.date_start")</label>
                <p class="text-muted">{{$case->date_start ?? __("site.null")}}</p>
            </div>

            <!-- Date End -->
            <div class="col-md-6">
                <label class="form-label fw-bold">@lang("site.date_end")</label>
                <p class="text-muted">{{$case->date_end ?? __("site.null")}}</p>
            </div>
             <!-- address -->
             <div class="col-6">
                <label class="form-label fw-bold">@lang("site.address")</label>
                <dl class="row">
                    <dt class="col-sm-3">@lang('site.city'):</dt>
                    <dd class="col-sm-9">{{ optional(optional($case->user)->city)->nameLang() }}</dd>

                    <dt class="col-sm-3">@lang('site.region'):</dt>
                    <dd class="col-sm-9">{{ optional(optional($case->user)->region)->nameLang() }}</dd>

                    <dt class="col-sm-3">@lang('site.area'):</dt>
                    <dd class="col-sm-9">{{ optional($case->details)->area }}</dd>

                    <dt class="col-sm-3">@lang('site.street'):</dt>
                    <dd class="col-sm-9">{{ optional($case->details)->street }}</dd>

                    <dt class="col-sm-3">@lang('site.district'):</dt>
                    <dd class="col-sm-9">{{ optional($case->details)->district }}</dd>

                    <dt class="col-sm-3">@lang('site.building'):</dt>
                    <dd class="col-sm-9">{{ optional($case->details)->building }}</dd>

                    <dt class="col-sm-3">@lang('site.floor'):</dt>
                    <dd class="col-sm-9">{{ optional($case->details)->floor }}</dd>

                    <dt class="col-sm-3">@lang('site.apartment'):</dt>
                    <dd class="col-sm-9">{{ optional($case->details)->apartment }}</dd>
                </dl>
            </div>
            <div class="col-6">
                <dt class="col-sm-3">@lang('site.code_name'):</dt>
                <dd class="col-sm-9">{{ optional($case->details)->code_name }}</dd>
                <dt class="col-sm-3">@lang('site.national_number'):</dt>
                <dd class="col-sm-9">{{ optional($case->details)->national_number }}</dd>
                <dt class="col-sm-3">@lang('site.condition'):</dt>
                <dd class="col-sm-9">{{ optional($case->details)->condition }}</dd>
                <dt class="col-sm-3">@lang('site.number_of_peaple'):</dt>
                <dd class="col-sm-9">{{ optional($case->details)->number_of_peaple }}</dd>


            </div>

            <!-- Description -->
            <div class="col-12">
                <label class="form-label fw-bold">@lang("site.description")</label>
                <p class="text-muted">{{$case->descriptionLang() ?? __("site.null")}}</p>
            </div>


        </div>
    </div>
</div>


