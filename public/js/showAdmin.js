$('.show-btn').click(function () {
    let id = $(this).attr('data-id');
    let name = $(this).attr('data-name');
    let phone = $(this).attr('data-phone');
    let password = $(this).attr('data-desc-password');
    let lang = $(this).attr('data-lang');

    // احصل على الأدوار وتمريرها كـ array
     var roles = $(this).data('roles').toString().split(',');
     // إعادة تعيين جميع الخيارات
     $('#modalshowUserRole option').prop('selected', false);

     // تعيين الأدوار الجديدة
    //  $('#modalshowUserRole option').each(function() {
    //      if (roles.includes($(this).val())) {
    //          $(this).prop('selected', true); // تحديد الدور المناسب
    //      }
    //  });



    $('#show-form-id').val(id);
    $('#modalshowUserFirstName').val(name);
    $('#modalshowUserPhone').val(phone);
    $('#modalshowUserRole').val(roles);
    $('#modalshowUserLang').val(lang);


});
