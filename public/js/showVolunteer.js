$('.show-btn').click(function () {
    let id = $(this).attr('data-id');
    let name = $(this).attr('data-name');
    let phone = $(this).attr('data-phone');
    let password = $(this).attr('data-desc-password');

    let region = $(this).attr('data-region');
    let gender = $(this).attr('data-gender');


    $('#show-form-id').val(id);
    $('#modalshowUserFirstName').val(name);
    $('#modalshowUserPhone').val(phone);
    $('#modalshowUserPassword').val(password);
    $('#modalshowUserGender').val(gender);
    $('#modalshowUserRegion').val(region);
    
    $('#modalshowUserRegion').trigger('change');
    $('#modalshowUserGender').trigger('change');

 });
