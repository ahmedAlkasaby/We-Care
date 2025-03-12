$(document).ready(function () {
    // Initialize the repeater if necessary
    $('.repeater').repeater({
        initEmpty: true,
        show: function () {
            $(this).slideDown();
            $(this).find('.select2-container').remove();
            $(this).find('select').select2({
                dropdownParent: $(this).closest('.modal')
            });
       },
        hide: function (deleteElement) {
            if (confirm('Are you sure you want to delete this item?')) {
                $(this).slideUp(deleteElement);
            }
        }
    });
    // $('.repeater[data-repeater-list="items-confirm"]').repeater({
    //     initEmpty: true,
    //     show: function () {
    //         $(this).slideDown();
    //         $(this).find('.select2-container').remove();
    //         $(this).find('select').select2({
    //             dropdownParent: $(this).closest('.modal')
    //         });
    //    },
    //     hide: function (deleteElement) {
    //         if (confirm('Are you sure you want to delete this item?')) {
    //             $(this).slideUp(deleteElement);
    //         }
    //     },
    //     data: {
    //         items: 'items-confirm' // Ensure this matches your backend expectations
    //     }
    // });
});
// $(document).ready(function () {
//     // Initialize the repeater if necessary
//     $('.repeater-confirm').repeater({
//         initEmpty: true,
//         show: function () {
//             $(this).slideDown();
//             $(this).find('.select2-container').remove();
//             $(this).find('select').select2({
//                 dropdownParent: $(this).closest('.modal')
//             });
//        },
//         hide: function (deleteElement) {
//             if (confirm('Are you sure you want to delete this item?')) {
//                 $(this).slideUp(deleteElement);
//             }
//         }
//     });
// });
