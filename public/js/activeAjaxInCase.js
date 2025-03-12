var $jq = jQuery.noConflict();
$(document).ready(function() {
    // احصل على الـ CSRF token من الـ meta tag
    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    // إعداد الـ headers لإرسال الـ CSRF token
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': csrfToken
        }
    });

    console.log("jQuery is ready");

    // Event listener on the button click
    $('.toggle-case').on('click', function(e) {
        e.preventDefault();
        var caseId = $(this).data('case-id');
        console.log(caseId);
        var button = $(this);

        $.ajax({
            url: '/dashboard/cases/toggle/' + caseId, // Construct the URL for the AJAX request (GET request)
            type: 'GET', // Use GET method
            success: function(response) {
                console.log('success');

                // Toggle button class and icon
                if (response.active) {
                    button.removeClass('btn-danger').addClass('btn-success');
                    button.find('i').removeClass('fa-circle-xmark').addClass('fa-check');
                    $('.transfer-button-' + caseId).prop('disabled', false);
                    if ($('.case-status-' + caseId).hasClass('bg-label-danger')) {

                        $('.case-status-' + caseId).removeClass('bg-label-danger').addClass('bg-label-success');
                        $('.case-status-' + caseId).text('active');
                    }
                } else {
                    button.removeClass('btn-success').addClass('btn-danger');
                    button.find('i').removeClass('fa-check').addClass('fa-circle-xmark');
                    $('.transfer-button-' + caseId).prop('disabled', true);

                    if ($('.case-status-' + caseId).hasClass('bg-label-success')) {

                        $('.case-status-' + caseId).removeClass('bg-label-success').addClass('bg-label-danger');
                        $('.case-status-' + caseId).text('inactive');
                    }

                }

                // Update statistics
                $('#case-that-need-price-count').text(response.case_that_need_price);
                $('#case-that-need-items-count').text(response.case_that_need_items);
                $('#total-price-for-case-that-need-items').text(response.total_price_for_case_that_need_items + ' Egp');
                $('#total-price-for-case-that-need-price').text(response.total_price_for_case_that_need_price + ' Egp');

                // Reload filtered table
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
            },
            error: function(xhr) {
                alert('There was an error. Please try again.');
            }
        });
    });

    // function reloadScripts() {
    //     console.log('Reloading scripts...');
    //     // إعادة تهيئة select2
    //     $('.form-select').select2({
    //         dropdownParent: $('#caseFilter')
    //     });

    //     // تحميل السكربتات الأخرى باستخدام مسارات كاملة
    //     $.getScript("/js/archiveAjaxInCase.js")
    //         .done(function() {
    //             console.log('archiveAjaxInCase.js loaded successfully');
    //         })
    //         .fail(function(jqxhr, settings, exception) {
    //             console.error('Error loading archiveAjaxInCase.js:', exception);
    //         });

    //     $.getScript("/js/activeAjaxInCase.js")
    //         .done(function() {
    //             console.log('activeAjaxInCase.js loaded successfully');
    //         })
    //         .fail(function(jqxhr, settings, exception) {
    //             console.error('Error loading activeAjaxInCase.js:', exception);
    //         });

    //     $.getScript("/js/recycleAhaxInCase.js")
    //         .done(function() {
    //             console.log('recycleAhaxInCase.js loaded successfully');
    //         })
    //         .fail(function(jqxhr, settings, exception) {
    //             console.error('Error loading recycleAhaxInCase.js:', exception);
    //         });
    // }

});

