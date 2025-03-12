$(document).ready(function () {
    // Initialize the repeater if necessary
    $('.repeater').repeater({
        initEmpty: false,
        show: function () {
            $(this).slideDown();
            $(this).find('.select2-container').remove();
            $(this).find('select').select2();
        },
        hide: function (deleteElement) {
            if (confirm('Are you sure you want to delete this item?')) {
                $(this).slideUp(deleteElement);
            }
        }
    });

});
