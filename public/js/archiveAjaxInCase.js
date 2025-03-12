var $jq = jQuery.noConflict();
$(document).ready(function() {
    // إعداد الـ CSRF token
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': csrfToken
        }
    });

    // التعامل مع عملية الأرشفة عند النقر على زر الأرشفة
    $('.archive-case').on('click', function(e) {
        e.preventDefault();

        var caseId = $(this).data('case-id');
        var button = $(this);

        // تأكد من أن الحالة ليست مؤرشفة بالفعل
        if (button.hasClass('disabled')) {
            return;
        }

        // إرسال طلب AJAX لأرشفة الحالة
        $.ajax({
            url: '/dashboard/cases/archive/' + caseId,  // رابط الأرشفة
            type: 'GET',  // نوع الطلب POST
            headers: {
                'X-CSRF-TOKEN': csrfToken  // إرسال الـ CSRF token
            },
            success: function(response) {
                console.log('Case archived successfully');

                button.addClass('disabled');

                var toggleButton = $('.toggle-case[data-case-id="' + caseId + '"]');
                toggleButton.removeClass('btn-success btn-danger').addClass('btn-danger').prop('disabled', true);
                toggleButton.find('i').removeClass('fa-circle').addClass('fa-check fa-circle-xmark');

                var recycleButton = $('.recycle-case[data-case-id="' + caseId + '"]');
                recycleButton.prop('disabled',true);
                $('.transfer-button-' + caseId).prop('disabled', true);



                $('#case-that-need-price-count').text(response.case_that_need_price);
                $('#case-that-need-items-count').text(response.case_that_need_items);
                $('#total-price-for-case-that-need-items').text(response.total_price_for_case_that_need_items +' Egp');
                $('#total-price-for-case-that-need-price').text(response.total_price_for_case_that_need_price +' Egp');

                // let formData = $('form').serialize();
                // $.ajax({
                //     url: "/dashboard/cases",
                //     method: "GET",
                //     data: formData,
                //     success: function(response) {
                //         $('#table-filter').html(response); // عرض البيانات المحدثة في الـ div المخصص
                //         reloadScripts(); // إعادة تحميل السكريبتات اللازمة
                //     },
                //     error: function(xhr, status, error) {
                //         console.error('Error: ', error);  // طباعة الخطأ في الكونسول
                //         console.error('Status: ', status);
                //         console.error('Response: ', xhr.responseText);  // عرض استجابة السيرفر
                //     }
                // });


                // تعطيل الزر بعد الأرشفة

            },
            // error: function(xhr) {
            //     alert('There was an error. Please try again.');
            // }
        });
    });

    function reloadScripts() {
        console.log('Reloading scripts...');
        // إعادة تهيئة select2
        $('.form-select').select2({
            dropdownParent: $('#casesFilter')
        });

        // تحميل السكربتات الأخرى باستخدام مسارات كاملة
        $.getScript("/js/archiveAjaxInCase.js")
            .done(function() {
                console.log('archiveAjaxInCase.js loaded successfully');
            })
            .fail(function(jqxhr, settings, exception) {
                console.error('Error loading archiveAjaxInCase.js:', exception);
            });

        $.getScript("/js/activeAjaxInCase.js")
            .done(function() {
                console.log('activeAjaxInCase.js loaded successfully');
            })
            .fail(function(jqxhr, settings, exception) {
                console.error('Error loading activeAjaxInCase.js:', exception);
            });

        $.getScript("/js/recycleAhaxInCase.js")
            .done(function() {
                console.log('recycleAhaxInCase.js loaded successfully');
            })
            .fail(function(jqxhr, settings, exception) {
                console.error('Error loading recycleAhaxInCase.js:', exception);
            });
    }
});
