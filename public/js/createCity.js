$(document).on('click', '.add-new', function() {
    console.log('ADD');
    $('#citiesForm form')[0].reset();
    $('#citiesForm .select2').val(null).trigger('change');
    $('#citiesForm .form-control').removeClass('is-invalid').blur();
    $('#citiesForm .select2').removeClass('is-invalid').blur();
    $('#citiesForm .invalid-feedback').remove();
    $('#operationType').val('store');
});
