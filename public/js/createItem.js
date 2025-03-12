$(document).on('click', '.add-new', function() {
    console.log('ADD');
    $('#itemsForm form')[0].reset();
    $('#itemsForm .select2').val(null).trigger('change');
    $('#itemsForm .form-control').removeClass('is-invalid').blur();
    $('#itemsForm .select2').removeClass('is-invalid').blur();
    $('#itemsForm .invalid-feedback').remove();
    $('#operationType').val('store');
});
