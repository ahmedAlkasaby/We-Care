$(document).ready(function () {
    // Initialize the repeater
    $('.repeater').repeater({
        initEmpty: false,
        show: function () {
            $(this).slideDown();
            $(this).find('.select2-container').remove();
            $(this).find('select').select2();
        },
        hide: function (deleteElement) {
            // تحقق من عدد العناصر
            var itemsCount = $('.repeater .row').length;
            if (itemsCount > 1) {
                if (confirm('Are you sure you want to delete this item?')) {
                    $(this).slideUp(deleteElement);
                }
            } else {
                alert('You cannot delete the last item.');
            }
        }
    });
});
