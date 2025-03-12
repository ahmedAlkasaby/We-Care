<div class="modal fade" id="regionsForm" tabindex="-1" aria-labelledby="adminLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content p-3 p-md-4">
            <div class="modal-header py-4">
                <h5 class="modal-title" id="adminLabel">@lang('site.region')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body border-top">
                {!! Form::open([ 'id' => 'regions', 'class' => 'row g-3', 'enctype' => 'multipart/form-data']) !!}
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" id="operationType" name="operationType">

                    <div class="row ">
                        <div class="col-md-6 mb-3">
                            @include('admin.includes.form.text', ['id'=>'name-en' ,'label' => __('site.name en'), 'fieldName' => 'name_en', 'class' => 'form-control', 'place' => __('site.Enter name')])
                        </div>
                        <div class="col-md-6 mb-3">
                            @include('admin.includes.form.text', ['id'=>'name-ar', 'label' => __('site.name ar'), 'fieldName' => 'name_ar', 'class' => 'form-control', 'place' => __('site.Enter name')])
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            @include('admin.includes.form.select', ['id' => 'data-city-id' , 'label' => __('site.city'), 'fieldName' => 'city_id', 'fieldValue' => null, 'options' => $cities_array, 'required' => true, 'class' => 'form-select select2'])
                        </div>
                    </div>

                    <div class="mb-3">
                        @include('admin.includes.form.active')
                    </div>

                    @include('admin.includes.form.submit-discard')
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
