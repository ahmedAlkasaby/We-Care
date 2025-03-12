var $jq = jQuery.noConflict();
$(document).ready(function() {
    $('.toggle-category').on('click', function(e) {
        e.preventDefault();
        var categoryCaseId = $(this).data('category-id');
        var button = $(this);

        $.ajax({
            url: '/dashboard/category_cases/toggle/' + categoryCaseId, // Construct the URL for the AJAX request (GET request)
            type: 'GET', // Use GET method
            success: function(response) {
                if (response.active) {
                    button.removeClass('btn-danger').addClass('btn-success');
                    button.find('i').removeClass('fa-circle-xmark').addClass('fa-check');

                    if ($('.categoryCase-status-' + categoryCaseId).hasClass('bg-label-danger')) {
                        $('.categoryCase-status-' + categoryCaseId).removeClass('bg-label-danger').addClass('bg-label-success');
                        $('.categoryCase-status-' + categoryCaseId).text('active');
                    }

                } else {
                    button.removeClass('btn-success').addClass('btn-danger');
                    button.find('i').removeClass('fa-check').addClass('fa-circle-xmark');

                    if ($('.categoryCase-status-' + categoryCaseId).hasClass('bg-label-success')) {
                        $('.categoryCase-status-' + categoryCaseId).removeClass('bg-label-success').addClass('bg-label-danger');
                        $('.categoryCase-status-' + categoryCaseId).text('inactive');
                    }

                }
            },
            error: function(xhr) {
                alert('There was an error. Please try again.');
            }
        });
    });

    // function reloadScripts() {
    //     $.getScript("/js/active/activeAjaxInCategory.js");
    //     $.getScript("/js/search/searchAjaxInCategory.js");
    // }
});

