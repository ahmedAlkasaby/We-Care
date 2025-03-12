<script defer>
    $(document).ready(function() {
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        // إعداد الـ headers لإرسال الـ CSRF token
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });

        $('.make-as-read').on('click', function(e) {
            e.preventDefault(); // منع الزر من تنفيذ أي إجراء افتراضي

            var notificationId = $(this).data('notification-id');
            var row = $(this).closest('tr'); // الحصول على الصف الذي يحتوي على الزر
            // الحصول على ID الإشعار

            // إرسال طلب AJAX لتحديث حالة الإشعار
            $.ajax({
                url: "notifications/" + notificationId + "/makeAsRead", // تأكد من أن هذا هو المسار الصحيح
                type: 'PUT', // استخدام PUT لتحديث الحالة
                data: {
                    _token: csrfToken // إضافة توكن CSRF
                },
                success: function(response) {
                    row.remove(); // إزالة الصف من الجدول
                    // يمكنك هنا تحديث واجهة المستخدم إذا لزم الأمر
                },
                error: function(xhr) {
                    alert('حدث خطأ أثناء تحديث الإشعار.');
                    console.error(xhr.responseText);
                    console.error('ahha');
                }
            });
        });
    });
</script>
