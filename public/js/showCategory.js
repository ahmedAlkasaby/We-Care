$('.show-btn').click(function () {
    $('#show-form');

    let id = $(this).attr('data-id');
    let name_en = $(this).attr('data-name-en');
    let name_ar = $(this).attr('data-name-ar');
    let description_en = $(this).attr('data-desc-en');
    let description_ar = $(this).attr('data-desc-ar');
    let active = $(this).attr('data-active');

    $('#show-form-id').val(id);
    $('#show-form-name-en').val(name_en);
    $('#show-form-name-ar').val(name_ar);
    $('#show-form-desc-en').val(description_en);
    $('#show-form-desc-ar').val(description_ar);
    $('#active').val(active).trigger('change');
});
