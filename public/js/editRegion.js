$(document).on('click', '.edit-btn', function() {
    $('#regionsForm form')[0].reset();
    $('#regionsForm .select2').val(null).trigger('change');
    $('#regionsForm .form-control').removeClass('is-invalid').blur();
    $('#regionsForm .select2').removeClass('is-invalid').blur();
    $('#regionsForm .invalid-feedback').remove();
    $('#operationType').val('update');

    let id = $(this).attr('data-id');
    let name_en = $(this).attr('data-name-en');
    let name_ar = $(this).attr('data-name-ar');
    let city_id = $(this).attr('data-city-id');

    $('#id').val(id);
    $('#name-en').val(name_en);
    $('#name-ar').val(name_ar);

    $('#data-city-id').val(city_id).trigger('change');
});
