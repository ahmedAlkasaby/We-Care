$(document).on('click', '.add-new', function() {
    console.log('ADD');
    $('#regionsForm form')[0].reset();
    $('#regionsForm .select2').val(null).trigger('change');
    $('#regionsForm .form-control').removeClass('is-invalid').blur();
    $('#regionsForm .select2').removeClass('is-invalid').blur();
    $('#regionsForm .invalid-feedback').remove();
    $('#operationType').val('store');
});
