$('.recycle-case').on('click', function(e) {
    e.preventDefault();
    var caseId = $(this).data('case-id');
    console.log(caseId);
    var button = $(this);
$.ajax({
    url: '/dashboard/cases/recycle/' + caseId, // Construct the URL for the AJAX request
    type: 'GET',
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success: function(response) {
        console.log('success');

        // تحديث القيم في الـ DOM بناءً على الاستجابة
        $('#case-price-' + caseId).text(response.price); // تحديث السعر
        $('#case-remaining-' + caseId).text(response.remaining); // تحديث السعر المتبقي

        $('#case-that-need-price-count').text(response.case_that_need_price );
        $('#case-that-need-items-count').text(response.case_that_need_items );
        $('#total-price-for-case-that-need-items').text(response.total_price_for_case_that_need_items +' Egp');
        $('#total-price-for-case-that-need-price').text(response.total_price_for_case_that_need_price +' Egp');
        // يمكنك إضافة أي كود آخر تريده هنا
    },
    error: function(xhr) {
        alert('There was an error. Please try again.');
    }
});
});
