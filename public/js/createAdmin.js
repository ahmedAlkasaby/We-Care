$(document).on('click', '.add-new', function() {
    console.log('ADD');
    $('#adminsForm form')[0].reset();
    $('#adminsForm .select2').val(null).trigger('change');
    $('#adminsForm .form-control').removeClass('is-invalid').blur();
    $('#adminsForm .select2').removeClass('is-invalid').blur();
    $('#adminsForm .invalid-feedback').remove();
    $('#operationType').val('store');
});
