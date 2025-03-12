$(document).on('click', '.add-new', function() {
    $('#categoriesForm form')[0].reset();
    $('#categoriesForm .select2').val(null).trigger('change');
    $('#categoriesForm .form-control').removeClass('is-invalid').blur();
    $('#categoriesForm .select2').removeClass('is-invalid').blur();
    $('#categoriesForm .invalid-feedback').remove();
    $('#desc-en').empty().removeClass('is-invalid');
    $('#desc-ar').empty().removeClass('is-invalid');
    $('#operationType').val('store');
});
