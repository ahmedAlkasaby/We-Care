$(document).ready(function () {
    // Initialize Select2 for existing selects
    $('select').select2();

    // Initialize the repeater
    $('.repeater').repeater({
        initEmpty: false, // لجعل العنصر يبدأ غير فارغ إذا لزم الأمر
        show: function () {
            // إظهار العنصر الجديد
            $(this).slideDown();

            // إعادة تهيئة Select2 للعناصر الجديدة
            $(this).find('.select2-container').remove(); // إزالة أي تهيئة سابقة
            $(this).find('select').select2({
                width: '100%' // ضمان عرض كامل لـ Select2
            });
        },
        hide: function (deleteElement) {
            // تأكيد الحذف مع الرسالة
            if (confirm('Are you sure you want to delete this item?')) {
                $(this).slideUp(deleteElement);
            }
        }
    });
});
