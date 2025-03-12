$(document).ready(function() {

    function fetchCases(page = 1, formData = '') {
        $.ajax({
            url: "/dashboard/cases" + "?page=" + page,
            method: "GET",
            data: formData,
            success: function(response) {
                $('#table-filter').html(response);
                reloadScripts();
            },
            error: function(xhr, status, error) {
                // Show error details in console
                console.error('Error:', error);
                console.error('Status:', status);

                // Parse and display the error response
                try {
                    let errorResponse = JSON.parse(xhr.responseText);
                    console.error('Error details:', {
                        message: errorResponse.message,
                        exception: errorResponse.exception,
                        file: errorResponse.file,
                        line: errorResponse.line
                    });

                    // Show user-friendly error message
                    alert('An error occurred while loading the data. Please try again later.');
                } catch(e) {
                    console.error('Failed to parse error response:', xhr.responseText);
                }
            }
        });
    }

    // Filter button click handler
    $('#filter-submit-btn').click(function(event) {
        event.preventDefault();
        let formData = $('form').serialize();
        fetchCases(1, formData);
    });

    // Search button click handler
    $('#search-submit-btn').click(function(event) {
        event.preventDefault();
        let form = $(this).closest('form');
        let formData = form.serialize();
        fetchCases(1, formData);
    });

    // Pagination click handler
    $(document).on('click', '.pagination a', function(event) {
        event.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        let formData = $('form').serialize();
        fetchCases(page, formData);
    });

    // Function to reload required scripts after content update
   // تعديل دالة reloadScripts لاستدعاء الدوال الجديدة بعد تحميل الملفات
function reloadScripts() {
    $('.form-select').select2({
        dropdownParent: $('#casesFilter')
    });

    $.getScript("/js/activeAjaxInCase.js")
        .done(function() {
            console.log('activeAjaxInCase.js loaded successfully');
        })
        .fail(function(jqxhr, settings, exception) {
            console.error('Error loading activeAjaxInCase.js:', exception);
        });

    $.getScript("/js/createTransfer.js")
        .done(function() {
            console.log('createTransfer.js loaded successfully');
            // استدعاء الدوال الخاصة بالأحداث بعد تحميل createTransfer.js
            initializeAmountInputs();
            initializePriceInputs();
        })
        .fail(function(jqxhr, settings, exception) {
            console.error('Error loading createTransfer.js:', exception);
            });
    // $.getScript("/js/transferAjaxStoreInCase.js")
    //     .done(function() {
    //         console.log('transferAjaxStoreInCase.js loaded successfully');

    //     })
    //     .fail(function(jqxhr, settings, exception) {
    //         console.error('Error loading transferAjaxStoreInCase.js:', exception);
    //         });
    }

});
