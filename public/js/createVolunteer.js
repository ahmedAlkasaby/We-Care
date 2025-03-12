$(document).on('click', '.add-new', function() {
    console.log('ADD');
    $('#volunteersForm form')[0].reset();
    $('#volunteersForm .select2').val(null).trigger('change');
    $('#volunteersForm .form-control').removeClass('is-invalid').blur();
    $('#volunteersForm .select2').removeClass('is-invalid').blur();
    $('#volunteersForm .invalid-feedback').remove();
    $('#operationType').val('store');
});
