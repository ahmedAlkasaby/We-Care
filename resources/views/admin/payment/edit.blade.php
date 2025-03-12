<div class="modal fade" id="adminShow" tabindex="-1" aria-labelledby="adminLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content p-3 p-md-4">
            <div class="modal-header">
                <h5 class="modal-title" id="adminLabel">@lang('site.Edit')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body border-top">
                {{ Form::open(['route' => ["payments.update", 1], 'method' => "PUT", 'enctype' => "multipart/form-data", 'class' => "needs-validation"]) }}
                <input type="hidden" name="id" id="edit-form-id" value="{{ $payment->id }}">
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        @include('admin.includes.form.text', ['label' => __('site.name en'), 'id' => "edit-form-name-en", 'fieldName' => 'name_en', 'class' => 'form-control', 'place' => __('site.Enter name')])
                    </div>
                    <div class="col-md-6 mb-3">
                        @include('admin.includes.form.text', ['label' => __('site.name ar'), 'id' => "edit-form-name-ar", 'fieldName' => 'name_ar', 'class' => 'form-control', 'place' => __('site.Enter name')])
                    </div>
                </div>
                
                @include('admin.includes.form.submit-discard')
                
                {!! Form::close() !!} <!-- Form End -->
            </div>
        </div>
    </div>
</div>

@section('js')
<script>
    $('.edit-btn').click(function () {
        let id = $(this).attr('data-id');
        let name_en = $(this).attr('data-name-en');
        let name_ar = $(this).attr('data-name-ar');

        $('#edit-form-id').val(id);
        $('#edit-form-name-en').val(name_en);
        $('#edit-form-name-ar').val(name_ar);
    });
</script>
@endsection
