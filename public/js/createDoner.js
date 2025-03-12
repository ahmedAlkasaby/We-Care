$(document).on('click', '.add-new', function() {
    console.log('ADD');
    $('#donersForm form')[0].reset();
    $('#donersForm .select2').val(null).trigger('change');
    $('#donersForm .form-control').removeClass('is-invalid').blur();
    $('#donersForm .select2').removeClass('is-invalid').blur();
    $('#donersForm .invalid-feedback').remove();
    $('#operationType').val('store');
});