
document.addEventListener('DOMContentLoaded', function() {
    initializeAmountInputs();
    initializePriceInputs();
});

function initializeAmountInputs() {
    const itemAmountInputs = document.querySelectorAll('.item-amount');
    itemAmountInputs.forEach(function(input) {
        input.addEventListener('input', function() {
            const row = input.closest('tr');
            const inStockElement = row.querySelector('.in-stock');
            const caseNeedElement = row.querySelector('.case_need_item');

            if (inStockElement && caseNeedElement) {
                const inStock = parseFloat(inStockElement.innerText);
                const caseNeed = parseFloat(caseNeedElement.innerText);

                console.log('inStock:', inStock);
                console.log('caseNeed:', caseNeed);
                console.log('input.value:', input.value);

                if (!isNaN(inStock) && !isNaN(caseNeed)) {
                    if (parseFloat(input.value) > inStock) {
                        alert('القيمة المدخلة أكبر من المتوفر في المخزون.');
                        input.value = inStock;
                    } else if (parseFloat(input.value) > caseNeed) {
                        alert('القيمة المدخلة أكبر من الحاجة الفعلية للحالة.');
                        input.value = caseNeed;
                    } else if (parseFloat(input.value) < 0) {
                        alert('القيمة المدخلة يجب أن تكون قيمة موجبة.');
                        input.value = 0;
                    }
                } else {
                    console.warn('inStock أو caseNeed ليس رقمًا.');
                }
            } else {
                console.warn('لم يتم العثور على inStock أو caseNeed في الصف.');
            }
        });
    });
}

function initializePriceInputs() {
    const priceInputs = document.querySelectorAll('.price-input');
    priceInputs.forEach(function(priceInput) {
        const row = priceInput.closest('tr');
        const storagePriceElement = row.querySelector('.storage-price');
        const caseNeedPriceElement = row.querySelector('.case_need_price');

        if (storagePriceElement && caseNeedPriceElement) {
            const storagePrice = parseFloat(storagePriceElement.innerText);
            const caseNeedPrice = parseFloat(caseNeedPriceElement.innerText);

            console.log('storagePrice:', storagePrice);
            console.log('caseNeedPrice:', caseNeedPrice);
            console.log('priceInput.value:', priceInput.value);

            priceInput.addEventListener('input', function() {
                const inputValue = parseFloat(priceInput.value);

                if (!isNaN(storagePrice) && !isNaN(caseNeedPrice)) {
                    if (inputValue > storagePrice) {
                        alert('القيمة المدخلة أكبر من المتوفر في المخزون.');
                        priceInput.value = storagePrice;
                    } else if (inputValue > caseNeedPrice) {
                        alert('القيمة المدخلة أكبر من الحاجة الفعلية للحالة.');
                        priceInput.value = caseNeedPrice;
                    } else if (inputValue < 0) {
                        alert('القيمة المدخلة يجب أن تكون قيمة موجبة.');
                        priceInput.value = 0;
                    }
                } else {
                    console.warn('storagePrice أو caseNeedPrice ليس رقمًا.');
                }
            });
        } else {
            console.warn('لم يتم العثور على storagePrice أو caseNeedPrice في الصف.');
        }
    });
}
