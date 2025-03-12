$(document).on('click', '.edit-btn', function() {

    $('#itemsForm form')[0].reset();
    $('#itemsForm .select2').val(null).trigger('change');
    $('#itemsForm .form-control').removeClass('is-invalid').blur();
    $('#itemsForm .select2').removeClass('is-invalid').blur();
    $('#itemsForm .invalid-feedback').remove();
    $('#operationType').val('update');


    let id = $(this).attr('data-id');
    let name_en = $(this).attr('data-name-en');
    let name_ar = $(this).attr('data-name-ar');
    let description_en = $(this).attr('data-desc-en');
    let description_ar = $(this).attr('data-desc-ar');
    let price = $(this).attr('data-price');
    let category_id = $(this).attr('data-category_id');

    $('#id').val(id);
    $('#name-en').val(name_en);
    $('#name-ar').val(name_ar);
    $('#desc-en').val(description_en);
    $('#desc-ar').val(description_ar);
    $('#edit-form-price').val(price);
    $('#category_id').val(category_id);
    $('#category_id').trigger('change');
});
