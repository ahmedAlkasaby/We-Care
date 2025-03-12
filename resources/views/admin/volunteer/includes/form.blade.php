<div class="modal fade" id="volunteersForm" tabindex="-1" aria-labelledby="volunteersFormLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content p-3 p-md-4">
            <div class="modal-header">
                <h5 class="modal-title" id="volunteerLabel">@lang('site.volunteer')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body border-top">
                {!! Form::open([ 'id' => 'volunteers', 'class' => 'row g-3', 'enctype' => 'multipart/form-data']) !!}
                <input type="hidden" name="id" id="id">
                <input type="hidden" id="operationType" name="operationType">


                    <div class="col-12">
                        @include('admin.includes.form.text', ['label' => __('site.admin name'), 'id' => 'name', 'fieldName' => 'name', 'fieldValue' => null, 'place' => __('site.admin name'), 'required' => true])
                    </div>

                    <div class="col-12">
                        @include('admin.includes.form.select', ['label' => __('site.address'),'fieldName' => 'region_id',"id"=>"region_id",'options' =>  $cities->mapWithKeys(function ($city) {
                            return [
                                $city->nameLang() => $city->regions->mapWithKeys(function ($region) {
                                    return [$region->id => $region->nameLang()];
                                })->toArray(),
                            ];
                        })->toArray(),'fieldValue' =>null,'class' => 'form-select select2','required' => true])
                    </div>

                    <div class="col-12 col-md-6">
                        @include('admin.includes.form.select', ['label' => __('site.admin lang'), 'id' => 'lang', 'fieldName' => 'lang', 'options' => ['ar' => __('site.language arabic'), 'en' => __('site.language english')], 'fieldValue' => null, 'class' => 'form-select select2', 'required' => true])
                    </div>

                    <div class="col-sm-6">
                        @include('admin.includes.form.select', ['label' => __('site.gender'), 'id' => 'gender', 'fieldName' => 'gender', 'options' => ['male' => __('site.male'), 'female' => __('site.female')], 'fieldValue' => null, 'class' => 'form-select select2', 'required' => true])
                    </div>

                    <div class="col-12">
                        @include('admin.includes.form.text', ['label' => __('site.admin phone'), 'fieldName' => 'phone', 'id'=>'phone','fieldValue' => null, 'place' => __('site.admin phone'), 'required' => true])

                    </div>

                    <div class="col-12">
                        @include('admin.includes.form.password')
                    </div>

                    <div class="col-12">
                        @include('admin.includes.form.password_confirmation')
                    </div>

                    @include('admin.includes.form.submit-discard')
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
