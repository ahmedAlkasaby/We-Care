$(document).ready(function() {
    // Handle form submission via AJAX
    $(document).on('submit', 'form', function(event) {
        event.preventDefault();

        var form = $(this);
        var formData = form.serialize();
        var caseId = form.find('input[name="case_id"]').val();

        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "timeOut": "3000",
            "extendedTimeOut": "1000",
            "positionClass": "toast-top-right"
        };

        $.ajax({
            url: form.attr('action'),
            method: form.attr('method'),
            data: formData,
            success: function(response) {
                // Check if response is HTML instead of JSON
                if (typeof response === 'string' && response.includes('<table')) {
                    toastr.error('Received HTML response instead of JSON. Please refresh and try again.');
                    console.error('Invalid response type - received HTML:', response);
                    return;
                }

                // Try parsing response if it's a string
                if (typeof response === 'string') {
                    try {
                        response = JSON.parse(response);
                    } catch (e) {
                        console.error('Failed to parse response as JSON:', e);
                        toastr.error('Invalid response format. Please refresh and try again.');
                        return;
                    }
                }

                if (!response || !response.success) {
                    toastr.error('Error processing request');
                    console.error('Invalid response:', response);
                    return;
                }

                // Move toastr.success after validating response.message exists
                if (response.message) {
                    toastr.success(response.message);
                } else {
                    console.warn('Response message is missing');
                }

                if (!response.transfer) {
                    console.error('Response transfer data is missing');
                    toastr.error('Error updating transfer data');
                    return;
                }

                try {
                    let $modal = $('#caseTransfer_' + caseId);

                    // Close modal using Bootstrap 5 syntax
                    if ($modal.length) {
                        const bsModal = bootstrap.Modal.getInstance($modal[0]);
                        if (bsModal) {
                            bsModal.hide();
                        } else {
                            // If modal instance doesn't exist, create one and hide it
                            const newModal = new bootstrap.Modal($modal[0]);
                            newModal.hide();
                        }
                    } else {
                        console.error('Modal element not found');
                        toastr.error('Error finding modal');
                        return;
                    }

                    // Update the specific case row with new data
                    let transfer = response.transfer;
                    let caseData = transfer.case;

                    // Reset form inputs
                    form[0].reset();

                    // Update price and remaining amount
                    $(`#case-price-${caseId}`).text(caseData.price);
                    $(`#case-remaining-${caseId}`).text(caseData.price - caseData.price_raised);

                    // Update case status if needed
                    if (caseData.status) {
                        $(`.case-status-${caseId}`).text(caseData.status);
                    }

                    // Add highlight class to updated row
                    $(`#case-row-${caseId}`).addClass('highlight-updated-strong').fadeIn(100).fadeOut(100).fadeIn(100);
                    setTimeout(() => {
                        $(`#case-row-${caseId}`).removeClass('highlight-updated-strong').fadeIn('slow');
                    }, 3000);

                    // Update item amounts in modal if items exist
                    if (caseData.items && caseData.items.length > 0) {
                        caseData.items.forEach(item => {
                            let row = $(`#caseTransfer_${caseId}`).find(`input[value="items[${item.id}]"]`).closest('tr');
                            row.find('.case_need_item').text(item.amount - item.amount_raised);
                            row.find('.in-stock').text(item.amount);
                            row.find('.item-amount').val(0);
                        });
                    } else {
                        // Update price fields if no items
                        let modal = $(`#caseTransfer_${caseId}`);
                        modal.find('.case_need_price').text(caseData.price - caseData.price_raised);
                        modal.find('.price-input').val(0);
                    }

                } catch (err) {
                    console.error('Error updating UI:', err);
                    toastr.error('Error updating display');
                }
            },
            error: function(xhr) {
                // Handle errors
                var errors = xhr.responseJSON.errors;
                if (errors) {
                    var errorMessages = Object.values(errors).map(function(error) {
                        return error.join(', ');
                    }).join('\n');
                    alert(errorMessages);
                } else {
                    alert('An unexpected error occurred.');
                }
            }
        });
    });
});
