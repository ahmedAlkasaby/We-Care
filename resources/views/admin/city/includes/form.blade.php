<div class="modal fade" id="citiesForm" tabindex="-1" aria-labelledby="citiesFormLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content p-3 p-md-4">
            <div class="modal-header">
                <h5 class="modal-title" id="cityLabel">@lang('site.city')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body border-top">
                {!! Form::open([ 'id' => 'cities', 'class' => 'row g-3', 'enctype' => 'multipart/form-data']) !!}
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" id="operationType" name="operationType">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            @include('admin.includes.form.text', ['label' => __('site.name en'), 'id' => 'name-en', 'fieldName' => 'name_en', 'fieldValue' => null, 'class' => 'form-control', 'place' => __('site.Enter name')])
                        </div>
                        <div class="col-md-6 mb-3">
                            @include('admin.includes.form.text', ['label' => __('site.name ar'),'id' => 'name-ar',  'fieldName' => 'name_ar', 'fieldValue' => null, 'class' => 'form-control', 'place' => __('site.Enter name')])
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
