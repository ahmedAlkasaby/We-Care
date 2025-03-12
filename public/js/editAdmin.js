$(document).on('click', '.edit-btn', function() {
    console.log('edit');
    $('#adminsForm form')[0].reset();
    $('#adminsForm .select2').val(null).trigger('change');


    $('#adminsForm .form-control').removeClass('is-invalid').blur();
    $('#adminsForm .select2').removeClass('is-invalid').blur();
    $('#adminsForm .invalid-feedback').remove();
    $('#operationType').val('update');





    let id = $(this).attr('data-id');
    let name = $(this).attr('data-name');
    let phone = $(this).attr('data-phone');
    let lang = $(this).attr('data-lang');
    console.log(lang);

    let gender = $(this).attr('data-gender');
    var roles = $(this).data('roles').toString().split(',');
    let region = $(this).attr('data-region');
    console.log("Region ID:", region);

    $('#role_id option').prop('selected', false);

    $('#role_id option').each(function() {
        if (roles.includes($(this).val())) {
            $(this).prop('selected', true);
        }
    });

    $('#id').val(id);
    $('#name').val(name);
    $('#phone').val(phone);
    $('#role_id').trigger('change');
    $('#lang').val(lang).trigger('change');
    $('#gender').val(gender).trigger('change');
    $('#region_id').val(region).trigger('change');


});
