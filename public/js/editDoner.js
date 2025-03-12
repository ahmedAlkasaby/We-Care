$(document).on('click', '.edit-btn', function() {
    $('#donersForm form')[0].reset();
    $('#donersForm .select2').val(null).trigger('change');

    $('#donersForm .form-control').removeClass('is-invalid').blur();
    $('#donersForm .select2').removeClass('is-invalid').blur();
    $('#donersForm .invalid-feedback').remove();
    $('#operationType').val('update');



    let id = $(this).attr('data-id');
    let name = $(this).attr('data-name');
    let phone = $(this).attr('data-phone');
    let lang = $(this).attr('data-lang');

    let gender = $(this).attr('data-gender');
    let region = $(this).attr('data-region');

    $('#id').val(id);
    $('#name').val(name);
    $('#phone').val(phone);
    $('#lang').val(lang).trigger('change');
    $('#gender').val(gender).trigger('change');
    $('#region_id').val(region).trigger('change');
});