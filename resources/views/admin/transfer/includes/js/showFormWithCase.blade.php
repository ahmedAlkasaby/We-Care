$(document).ready(function() {
    $('.tranfer-button').on('click', function() {
        const caseId = $(this).data('case-id');
        const caseItemsData = $(this).data('case-items');
        let caseItems = [];

        if (caseItemsData) {
            try {
                caseItems = JSON.parse(caseItemsData);
            } catch (e) {
                console.error("Error parsing case items data:", e);
                return;
            }
        } else {
            console.warn("No case items data found");
        }

        const casePrice = $(this).data('case-price');
        const casePriceRaised = $(this).data('case-price-raised');
        const storagePrice = $(this).data('storage-price');

        // تحديث حقل case_id في الموديل
        $('#caseTransferForm input[name="case_id"]').val(caseId);

        const itemsTableBody = $('#caseTransfer .modal-body tbody');
        itemsTableBody.empty(); // تفريغ المحتوى الحالي

        if (caseItems.length > 0) {
            itemsTableBody.append(`
                <tr>
                    <th>@lang('site.item')</th>
                    <th>@lang('site.case_need')</th>
                    <th>@lang('site.unit_price')</th>
                    <th>@lang('site.in_stock')</th>
                    <th>@lang('site.amount')</th>
                </tr>
            `);

            caseItems.forEach(item => {
                const row = `
                    <tr>
                        <td>${item.nameLang}</td>
                        <td class="case_need_item">${item.pivot.amount - item.pivot.amount_raised}</td>
                        <td>${item.price}</td>
                        <td class="in-stock">${item.amount}</td>
                        <td>
                            <input class="form-control item-amount" type="number" step="1"
                            name="items[${item.id}][amount]" value="0">
                        </td>
                    </tr>
                `;
                itemsTableBody.append(row);
            });
        } else {
            itemsTableBody.append(`
                <tr>
                    <th>@lang('site.case_need')</th>
                    <th>@lang('site.in_storage')</th>
                    <th>@lang('site.amount')</th>
                </tr>
            `);

            const row = `
                <tr>
                    <td class="case_need_price">${casePrice - casePriceRaised}</td>
                    <td class="storage-price">${storagePrice}</td>
                    <td>
                        <input class="form-control price-input" type="number" step="1" name="price" value="0">
                    </td>
                </tr>
            `;
            itemsTableBody.append(row);
        }

        // تأكد من أن الموديل موجود في DOM قبل تهيئته
        const modalElement = document.getElementById('caseTransfer');
        if (modalElement) {
            const caseTransferModal = new bootstrap.Modal(modalElement);
            caseTransferModal.show();
        } else {
            console.error("Modal element not found");
        }
    });
});
