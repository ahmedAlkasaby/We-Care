var $jq = jQuery.noConflict();
$(document).ready(function() {
    $('.toggle-slider').on('click', function(e) {
        e.preventDefault();
        var sliderId = $(this).data('slider-id');
        var button = $(this);

        $.ajax({
            url: '/dashboard/sliders/toggle/' + sliderId, // Construct the URL for the AJAX request (GET request)
            type: 'GET', // Use GET method
            success: function(response) {
                if (response.active) {
                    button.removeClass('btn-danger').addClass('btn-success');
                    button.find('i').removeClass('fa-circle-xmark').addClass('fa-check');

                    if ($('.slider-status-' + sliderId).hasClass('bg-label-danger')) {
                        $('.slider-status-' + sliderId).removeClass('bg-label-danger').addClass('bg-label-success');
                        $('.slider-status-' + sliderId).text('active');
                    }

                } else {
                    button.removeClass('btn-success').addClass('btn-danger');
                    button.find('i').removeClass('fa-check').addClass('fa-circle-xmark');

                    if ($('.slider-status-' + sliderId).hasClass('bg-label-success')) {
                        $('.slider-status-' + sliderId).removeClass('bg-label-success').addClass('bg-label-danger');
                        $('.slider-status-' + sliderId).text('inactive');
                    }

                }
            },
            error: function(xhr) {
                alert('There was an error. Please try again.');
            }
        });
    });

    // function reloadScripts() {
    //     $.getScript("/js/active/activeAjaxInslider.js");
    //     $.getScript("/js/search/searchAjaxInslider.js");
    // }
});

