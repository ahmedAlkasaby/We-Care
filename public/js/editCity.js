$(document).on('click', '.edit-btn', function() {
    $('#citiesForm form')[0].reset();
    $('#citiesForm .select2').val(null).trigger('change');
    $('#citiesForm .form-control').removeClass('is-invalid').blur();
    $('#citiesForm .select2').removeClass('is-invalid').blur();
    $('#citiesForm .invalid-feedback').remove();
    $('#operationType').val('update');



    let id = $(this).attr('data-id');
    let namear = $(this).attr('data-name-ar');
    let nameen = $(this).attr('data-name-en');

    $('#id').val(id);
    $('#name-en').val(nameen);
    $('#name-ar').val(namear);
});
