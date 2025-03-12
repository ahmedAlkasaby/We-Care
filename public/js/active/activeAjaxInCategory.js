var $jq = jQuery.noConflict();
$(document).ready(function() {
    $('.toggle-category').on('click', function(e) {
        e.preventDefault();
        var categoryId = $(this).data('category-id');
        var button = $(this);

        $.ajax({
            url: '/dashboard/categories/toggle/' + categoryId, // Construct the URL for the AJAX request (GET request)
            type: 'GET', // Use GET method
            success: function(response) {
                if (response.active) {
                    button.removeClass('btn-danger').addClass('btn-success');
                    button.find('i').removeClass('fa-circle-xmark').addClass('fa-check');

                    if ($('.category-status-' + categoryId).hasClass('bg-label-danger')) {
                        $('.category-status-' + categoryId).removeClass('bg-label-danger').addClass('bg-label-success');
                        $('.category-status-' + categoryId).text('active');
                    }

                } else {
                    button.removeClass('btn-success').addClass('btn-danger');
                    button.find('i').removeClass('fa-check').addClass('fa-circle-xmark');

                    if ($('.category-status-' + categoryId).hasClass('bg-label-success')) {
                        $('.category-status-' + categoryId).removeClass('bg-label-success').addClass('bg-label-danger');
                        $('.category-status-' + categoryId).text('inactive');
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

