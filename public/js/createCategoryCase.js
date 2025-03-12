$(document).on('click', '.add-new', function() {
    $('#desc-en').empty().removeClass('is-invalid');
    $('#desc-ar').empty().removeClass('is-invalid');
    $('#categoriesCaseForm form')[0].reset();
    $('#categoriesCaseForm .select2').val(null).trigger('change');
    $('#categoriesCaseForm .form-control').removeClass('is-invalid').blur();
    $('#categoriesCaseForm .select2').removeClass('is-invalid').blur();
    $('#categoriesCaseForm .invalid-feedback').remove();
    $('#operationType').val('store');
});
