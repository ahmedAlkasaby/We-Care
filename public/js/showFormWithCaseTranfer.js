// public/js/showFormWithCaseTransfer.js

$(document).ready(function() {
    $('.tranfer-button').on('click', function() {
        const caseId = $(this).data('case-id');
        const casePrice = $(this).data('case-price');
        const casePriceRaised = $(this).data('case-price-raised');
        const storagePrice = $(this).data('storage-price');

        // تحديث حقل case_id في الموديل
        $('#caseTransferForm input[name="case_id"]').val(caseId);

        const itemsTableHead = $('#caseTransfer .modal-body thead');
        const itemsTableBody = $('#caseTransfer .modal-body tbody');
        itemsTableBody.empty(); // تفريغ المحتوى الحالي

        if (caseItems && caseItems.length > 0) {
            itemsTableHead.html(`
                <tr>
                    <th>${translations.item}</th>
                    <th>${translations.caseNeed}</th>
                    <th>${translations.unitPrice}</th>
                    <th>${translations.inStock}</th>
                    <th>${translations.amount}</th>
                </tr>
            `);

            caseItems.forEach(item => {
                const row = `
                    <tr>
                        <td>${item.name}</td>
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
            itemsTableHead.html(`
                <tr>
                    <th>${translations.caseNeed}</th>
                    <th>${translations.inStock}</th>
                    <th>${translations.amount}</th>
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
