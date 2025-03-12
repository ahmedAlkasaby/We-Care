<div class="modal fade" id="categoriesForm" tabindex="-1" aria-labelledby="adminLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content p-3 p-md-4">
            <div class="modal-header py-4">
                <h5 class="modal-title" id="adminLabel">@lang('site.category')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body border-top">
                {!! Form::open([ 'id' => 'categories', 'class' => 'row g-3', 'enctype' => 'multipart/form-data']) !!}
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" id="operationType" name="operationType">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            @include('admin.includes.form.text', ['id' => 'name-en','label' => __('site.name en'), 'fieldName' => 'name_en', 'fieldValue' => $name_en ?? null, 'class' => 'form-control', 'place' => __('site.Enter name')])
                        </div>
                        <div class="col-md-6 mb-3">
                            @include('admin.includes.form.text', ['id' => 'name-ar','label' => __('site.name ar'), 'fieldName' => 'name_ar', 'fieldValue' => null, 'class' => 'form-control', 'place' => __('site.Enter name')])
                        </div>
                    </div>

                    <div class="mb-3">
                        @include('admin.includes.form.textarea', ['id' => 'desc-en','label' => __('site.Description en'), 'fieldName' => 'description_en', 'fieldValue' => null, 'place' => __('site.Add a Description'), 'rows' => 4])
                    </div>

                    <div class="mb-3">
                        @include('admin.includes.form.textarea', ['id' => 'desc-ar','label' => __('site.Description ar'), 'fieldName' => 'description_ar', 'fieldValue' => null, 'place' => __('site.Add a Description'), 'rows' => 4])
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
