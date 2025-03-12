<div class="col-xl-8 col-lg-7 order-0 order-md-1">  
    <div class="row text-nowrap  row-cols-1 row-cols-md-2">
      <div class="col mb-3">
        <div class="card h-100">
          <div class="card-body">
            <div class="card-icon mb-2">
              <div class="avatar">
                <div class="avatar-initial rounded bg-label-primary">
                  <i class="ti ti-currency-dollar ti-lg"></i>
                </div>
              </div>
            </div>
            <div class="card-info">
              <h5 class="card-title mb-2">@lang("site.money")</h5>
              <div class="d-flex align-items-baseline gap-1">
                <h5 class="text-primary mb-0">{{$doner->donations->sum("price")}}@lang("site.egp")</h5>
              </div>
              <p class="mb-0 text-truncate">@lang("site.money which he donated it")</p>
            </div>
          </div>
        </div>
      </div>

      <div class="col mb-3">
        <div class="card h-100">
          <div class="card-body">
            <div class="card-icon mb-2">
              <div class="avatar">
                <div class="avatar-initial rounded bg-label-success">
                  <i class="ti ti-gift ti-lg"></i>
                </div>
              </div>
            </div>
            <div class="card-info">
              <h5 class="card-title mb-2">@lang("site.cases")</h5>
              <h5 class="text-success mb-0">{{$cases}}</h5>

              <p class="mb-0">@lang("site.total cases that he donated")</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Project table -->
    
    <!-- /Project table -->


    <!-- Invoice table -->
    <div class="card mb-4">

    </div>
    <!-- /Invoice table -->
  </div>