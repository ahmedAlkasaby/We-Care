<div class="modal fade" id="modalEcommercePaymentList" tabindex="-1" aria-labelledby="modalEcommercePaymentListLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content p-3 p-md-4">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEcommercePaymentListLabel">@lang('site.add')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body border-top">
                
                {{ Form::open(['route' => ["payments.store"], 'method' => "POST", 'enctype' => "multipart/form-data", 'class' => "needs-validation"]) }}
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        @include('admin.includes.form.text', ['label' => __('site.name en'), 'fieldName' => 'name_en', 'class' => 'form-control', 'place' => __('site.Enter name')])
                    </div>
                    <div class="col-md-6 mb-3">
                        @include('admin.includes.form.text', ['label' => __('site.name ar'), 'fieldName' => 'name_ar', 'class' => 'form-control', 'place' => __('site.Enter name')])
                    </div>
                </div>

                @include('admin.includes.form.submit-discard')
                
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

