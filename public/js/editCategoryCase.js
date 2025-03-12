$(document).on('click', '.edit-btn', function() {

    console.log('edit');
    $('#categoriesCaseForm form')[0].reset();
    $('#categoriesCaseForm .select2').val(null).trigger('change');
    $('#categoriesCaseForm .form-control').removeClass('is-invalid').blur();
    $('#desc-en').empty();
    $('#desc-ar').empty();
    $('#categoriesCaseForm .select2').removeClass('is-invalid').blur();
    $('#categoriesCaseForm .invalid-feedback').remove();
    $('#operationType').val('update');

    let id = $(this).attr('data-id');
    let name_en = $(this).attr('data-name-en');
    let name_ar = $(this).attr('data-name-ar');
    let description_en = $(this).attr('data-desc-en');
    let description_ar = $(this).attr('data-desc-ar');
    let active = $(this).attr('data-active');

    $('#id').val(id);
    $('#name-en').val(name_en);
    $('#name-ar').val(name_ar);
    $('#desc-en').text(description_en);
    $('#desc-ar').text(description_ar);

    if (active == "1") {
        $('#status').prop('checked', true);
    } else {
        $('#status').prop('checked', false);
    }});

