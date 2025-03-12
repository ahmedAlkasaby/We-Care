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
    $('.removefromarchive-case').on('click', function(e) {
        e.preventDefault();

        var caseId = $(this).data('case-id');
        var button = $(this);

        // تأكد من أن الحالة ليست مؤرشفة بالفعل
        if (button.hasClass('disabled')) {
            return;
        }

        // إرسال طلب AJAX لأرشفة الحالة
        $.ajax({
            url: '/dashboard/cases/remove-from-archive/' + caseId,  // رابط الأرشفة
            type: 'GET',  // نوع الطلب POST
            headers: {
                'X-CSRF-TOKEN': csrfToken  // إرسال الـ CSRF token
            },
            success: function(response) {
                console.log('Case archived successfully');

                button.addClass('disabled');

                var toggleButton = $('.toggle-case[data-case-id="' + caseId + '"]');
                toggleButton.removeClass('btn-success btn-danger').addClass('btn-success').prop('disabled', false);
                toggleButton.find('i').removeClass('fa-check fa-circle-xmark').addClass('fa-check');

                var recycleButton = $('.recycle-case[data-case-id="' + caseId + '"]');
                recycleButton.prop('disabled',false);
                $('.transfer-button-' + caseId).prop('disabled', false);

                var archiveButton = $('.archive-case[data-case-id="' + caseId + '"]');
                archiveButton.prop('disabled',false);


                $('#case-that-need-price-count').text(response.case_that_need_price);
                $('#case-that-need-items-count').text(response.case_that_need_items);
                $('#total-price-for-case-that-need-items').text(response.total_price_for_case_that_need_items +' Egp');
                $('#total-price-for-case-that-need-price').text(response.total_price_for_case_that_need_price +' Egp');





            },
            error: function(xhr) {
                alert('There was an error. Please try again.');
            }
        });
    });

});
