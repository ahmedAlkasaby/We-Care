// document.addEventListener('DOMContentLoaded', function () {
//     let initialDonationPriceItems = 0; // السعر الأصلي للتبرع للعناصر
//     let initialDonationPriceMoney = 0; // السعر الأصلي للتبرع للأموال

//     // التعامل مع فتح المودال للعناصر
//     document.querySelectorAll('[data-bs-toggle="modal"][data-bs-target^="#donationTransferItems_"]').forEach(function (button) {
//         button.addEventListener('click', function () {
//             let modal = document.querySelector(button.getAttribute('data-bs-target'));
//             let donationPriceElement = modal.querySelector('.donation-price');


//             initialDonationPriceItems = parseFloat(donationPriceElement.textContent.trim()) || 0;


//         });
//     });

//     // التعامل مع تغيير الكميات داخل المودال للعناصر
//     document.addEventListener('input', function (event) {
//         if (event.target.matches('input[type="number"]')) {

//             // تأكد من أن المدخل هو لعنصر وليس للأموال
//             if (event.target.closest('.items-modal')) { // تحقق من أن المدخل موجود داخل مودال العناصر
//                 console.log('items');
//                 updateDonationPriceItems(event.target);
//             }
//         }
//     });

//     function updateDonationPriceItems(input) {
//         let row = input.closest('tr');

//         if (row) {
//             let inStock = parseFloat(row.dataset.inStock) || 0;
//             let itemPrice = parseFloat(row.dataset.itemPrice) || 0;

//             // التحقق من تجاوز الكمية المتاحة
//             if (parseFloat(input.value) > inStock) {
//                 alert('لقد تجاوزت الكمية المتاحة في المخزون!');
//                 input.value = inStock; // إعادة تعيين القيمة إلى الحد الأقصى
//             }

//             let totalDeducted = 0;

//             // حساب المجموع
//             document.querySelectorAll('input[type="number"]').forEach(function (input) {
//                 let row = input.closest('tr');
//                 if (row) {
//                     let itemPrice = parseFloat(row.dataset.itemPrice) || 0;
//                     let quantity = parseFloat(input.value) || 0;
//                     totalDeducted += itemPrice * quantity;
//                 }
//             });

//             // تحقق من أن التبرع لا يتجاوز المبلغ الأصلي
//             if (totalDeducted > initialDonationPriceItems) {
//                 alert('التبرع بالعناصر يتجاوز المبلغ المطلوب!');
//                 input.value=0;

//             }

//             // تحديث سعر التبرع المتبقي
//             let newDonationPrice = initialDonationPriceItems - totalDeducted;

//             if (!isNaN(newDonationPrice) && newDonationPrice >= 0) {
//                 document.querySelectorAll('.donation-price').forEach(function (priceElement) {
//                     priceElement.textContent = newDonationPrice.toFixed(2);
//                 });
//             }
//         }
//     }

//     // التعامل مع فتح المودال للأموال
//     document.querySelectorAll('[data-bs-toggle="modal"][data-bs-target^="#donationTransferPrice_"]').forEach(function (button) {
//         button.addEventListener('click', function () {
//             let modal = document.querySelector(button.getAttribute('data-bs-target'));
//             let donationPriceElement = modal.querySelector('.donation-money');

//             // تعيين السعر الأصلي عند فتح المودال
//             initialDonationPriceMoney = parseFloat(donationPriceElement.dataset.initialDonation) || 0;
//         });
//     });

//     // التعامل مع تغيير الكميات داخل المودال للأموال
//     document.addEventListener('input', function (event) {
//         if (event.target.matches('input.price-input')) {

//             // تأكد من أن المدخل هو للأموال وليس للعناصر
//             if (event.target.closest('.money-modal')) { // تحقق من أن المدخل موجود داخل مودال الأموال
//                 console.log('price');
//                 updateDonationPriceMoney(event.target);
//             }
//         }
//     });

//     function updateDonationPriceMoney(input) {
//         let enteredValue = parseFloat(input.value) || 0;
//         let inStock = parseFloat(input.dataset.inStock) || 0;

//         // التحقق من تجاوز المخزون
//         if (enteredValue > inStock) {
//             alert('القيمة المدخلة أكبر من المخزون المتاح!');
//             input.value = inStock; // إعادة تعيين القيمة إلى الحد الأقصى
//             enteredValue = inStock; // تحديث القيمة المدخلة
//         }

//         if (enteredValue > initialDonationPriceMoney) {
//             alert('المبلغ المتبرع به يتجاوز المبلغ المطلوب!');
//             input.value = initialDonationPriceMoney; // تعيين القيمة إلى المبلغ المتبقي
//             enteredValue = initialDonationPriceMoney;
//         }

//         // حساب السعر المتبقي
//         let newDonationPrice = initialDonationPriceMoney - enteredValue;

//         // تحديث قيمة التبرع المتبقية
//         if (!isNaN(newDonationPrice) && newDonationPrice >= 0) {
//             document.querySelectorAll('.donation-money').forEach(function (priceElement) {
//                 priceElement.textContent = newDonationPrice.toFixed(2);
//             });
//         }
//     }
// });

// document.addEventListener('DOMContentLoaded', function () {

//     let initialDonationPriceItems = 0; // السعر الأصلي للتبرع للعناصر
//     let initialDonationPriceMoney = 0; // السعر الأصلي للتبرع للأموال
//     // التعامل مع فتح المودال للعناصر
//     document.querySelectorAll('[data-bs-toggle="modal"][data-bs-target^="#donationTransferItems_"]').forEach(function (button) {
//         button.addEventListener('click', function () {
//             let modal = document.querySelector(button.getAttribute('data-bs-target'));
//             let donationPriceElement = modal.querySelector('.donation-price');

//             // تعيين السعر الأصلي عند فتح المودال للعناصر
//             modal.dataset.initialDonationPriceItems = parseFloat(donationPriceElement.textContent.trim()) || 0;
//         });
//     });

//     // التعامل مع تغيير الكميات داخل المودال للعناصر
//     document.addEventListener('input', function (event) {
//         if (event.target.matches('input[type="number"]')) {
//             if (event.target.closest('.items-modal')) {
//                 updateDonationPriceItems(event.target);
//             }
//         }
//     });

//     function updateDonationPriceItems(input) {
//         let row = input.closest('tr');
//         let modal = input.closest('.items-modal');
//         let initialDonationPriceItems = parseFloat(modal.dataset.initialDonationPriceItems) || 0;

//         if (row) {
//             let inStock = parseFloat(row.dataset.inStock) || 0;
//             let itemPrice = parseFloat(row.dataset.itemPrice) || 0;

//             if (parseFloat(input.value) > inStock) {
//                 alert('لقد تجاوزت الكمية المتاحة في المخزون!');
//                 input.value = inStock;
//             }

//             let totalDeducted = 0;

//             document.querySelectorAll('.items-modal input[type="number"]').forEach(function (input) {
//                 let row = input.closest('tr');
//                 if (row) {
//                     let itemPrice = parseFloat(row.dataset.itemPrice) || 0;
//                     let quantity = parseFloat(input.value) || 0;
//                     totalDeducted += itemPrice * quantity;
//                 }
//             });

//             if (totalDeducted > initialDonationPriceItems) {
//                 alert('التبرع بالعناصر يتجاوز المبلغ المطلوب!');
//                 input.value = 0;
//             }

//             let newDonationPrice = initialDonationPriceItems - totalDeducted;

//             if (!isNaN(newDonationPrice) && newDonationPrice >= 0) {
//                 modal.querySelectorAll('.donation-price').forEach(function (priceElement) {
//                     priceElement.textContent = newDonationPrice.toFixed(2);
//                 });
//             }
//         }
//     }

//     // التعامل مع فتح المودال للأموال
//     document.querySelectorAll('[data-bs-toggle="modal"][data-bs-target^="#donationTransferPrice_"]').forEach(function (button) {
//         button.addEventListener('click', function () {
//             let modal = document.querySelector(button.getAttribute('data-bs-target'));
//             let donationPriceElement = modal.querySelector('.donation-money');

//             // تعيين السعر الأصلي عند فتح المودال للأموال
//             modal.dataset.initialDonationPriceMoney = parseFloat(donationPriceElement.dataset.initialDonation) || 0;
//         });
//     });

//     // التعامل مع تغيير الكميات داخل المودال للأموال
//     document.addEventListener('input', function (event) {
//         if (event.target.matches('input.price-input')) {
//             if (event.target.closest('.money-modal')) {
//                 updateDonationPriceMoney(event.target);
//             }
//         }
//     });

//     function updateDonationPriceMoney(input) {
//         let modal = input.closest('.money-modal');
//         let initialDonationPriceMoney = parseFloat(modal.dataset.initialDonationPriceMoney) || 0;
//         let enteredValue = parseFloat(input.value) || 0;
//         let inStock = parseFloat(input.dataset.inStock) || 0;

//         if (enteredValue > inStock) {
//             alert('القيمة المدخلة أكبر من المخزون المتاح!');
//             input.value = inStock;
//             enteredValue = inStock;
//         }

//         if (enteredValue > initialDonationPriceMoney) {
//             alert('المبلغ المتبرع به يتجاوز المبلغ المطلوب!');
//             input.value = initialDonationPriceMoney;
//             enteredValue = initialDonationPriceMoney;
//         }

//         let newDonationPrice = initialDonationPriceMoney - enteredValue;

//         if (!isNaN(newDonationPrice) && newDonationPrice >= 0) {
//             modal.querySelectorAll('.donation-money').forEach(function (priceElement) {
//                 priceElement.textContent = newDonationPrice.toFixed(2);
//             });
//         }
//     }
// });




document.addEventListener('DOMContentLoaded', function () {
    let initialDonationPriceItems = 0; // السعر الأصلي للتبرع للعناصر
    let initialDonationPriceMoney = 0; // السعر الأصلي للتبرع للأموال

    // التعامل مع فتح المودال للعناصر
    document.querySelectorAll('[data-bs-toggle="modal"][data-bs-target^="#donationTransferItems_"]').forEach(function (button) {
        button.addEventListener('click', function () {
            let modal = document.querySelector(button.getAttribute('data-bs-target'));
            let donationPriceElement = modal.querySelector('.donation-price');

            initialDonationPriceItems = parseFloat(donationPriceElement.textContent.trim()) || 0;

            modal.querySelectorAll('input[type="number"]').forEach(function (input) {
                input.value = 0; // إعادة تعيين القيمة إلى 0
            });

            updateDonationPriceItems(modal);
        });
    });

    // التعامل مع تغيير الكميات داخل المودال للعناصر
    document.addEventListener('input', function (event) {
        if (event.target.matches('input[type="number"]') && event.target.closest('.items-modal')) {
            updateDonationPriceItems(event.target.closest('.items-modal'));
        }
    });

    function updateDonationPriceItems(modal) {
        let totalDeducted = 0;

        modal.querySelectorAll('input[type="number"]').forEach(function (input) {
            let row = input.closest('tr');
            if (row) {
                let itemPrice = parseFloat(row.dataset.itemPrice) || 0;
                let quantity = parseFloat(input.value) || 0;
                totalDeducted += itemPrice * quantity;
            }
        });

        if (totalDeducted > initialDonationPriceItems) {
            alert('التبرع بالعناصر يتجاوز المبلغ المطلوب!');
            return; // إيقاف العملية إذا تجاوز المبلغ
        }

        let newDonationPrice = initialDonationPriceItems - totalDeducted;

        modal.querySelector('.donation-price').textContent = newDonationPrice.toFixed(2);
    }

    // التعامل مع فتح المودال للأموال
    document.querySelectorAll('[data-bs-toggle="modal"][data-bs-target^="#donationTransferPrice_"]').forEach(function (button) {
        button.addEventListener('click', function () {
            let modal = document.querySelector(button.getAttribute('data-bs-target'));
            let donationPriceElement = modal.querySelector('.donation-money');

            initialDonationPriceMoney = parseFloat(donationPriceElement.dataset.initialDonation) || 0;

            modal.querySelectorAll('input.price-input').forEach(function (input) {
                input.value = 0;
            });

            updateDonationPriceMoney(modal);
        });
    });

    // التعامل مع تغيير الكميات داخل المودال للأموال
    document.addEventListener('input', function (event) {
        if (event.target.matches('input.price-input') && event.target.closest('.money-modal')) {
            updateDonationPriceMoney(event.target.closest('.money-modal'));
        }
    });

    function updateDonationPriceMoney(modal) {
        let totalDeducted = 0;

        modal.querySelectorAll('input.price-input').forEach(function (input) {
            let value = parseFloat(input.value) || 0;
            totalDeducted += value;
        });

        if (totalDeducted > initialDonationPriceMoney) {
            alert('المبلغ المتبرع به يتجاوز المبلغ المطلوب!');
            // Reset all inputs to 0
            modal.querySelectorAll('input.price-input').forEach(function (input) {
                input.value = 0;
            });
            totalDeducted = 0;
        }

        let newDonationPrice = initialDonationPriceMoney - totalDeducted;
        modal.querySelector('.donation-money').textContent = newDonationPrice.toFixed(2);
    }
});


// document.addEventListener('DOMContentLoaded', function () {
//     let initialDonationPriceItems = 0; // السعر الأصلي للتبرع للعناصر
//     let initialDonationPriceMoney = 0; // السعر الأصلي للتبرع للأموال

//     // التعامل مع فتح المودال للعناصر
//     document.querySelectorAll('[data-bs-toggle="modal"][data-bs-target^="#donationTransferItems_"]').forEach(function (button) {
//         button.addEventListener('click', function () {
//             let modal = document.querySelector(button.getAttribute('data-bs-target'));
//             let donationPriceElement = modal.querySelector('.donation-price');

//             // تعيين السعر الأصلي عند فتح المودال
//             initialDonationPriceItems = parseFloat(donationPriceElement.textContent.trim()) || 0;

//             // إعادة تعيين جميع المدخلات داخل المودال
//             modal.querySelectorAll('input[type="number"]').forEach(function (input) {
//                 input.value = 0; // إعادة تعيين القيمة إلى 0
//             });

//             // تحديث السعر بعد إعادة تعيين المدخلات
//             document.querySelectorAll('.donation-price').forEach(function (priceElement) {
//                 priceElement.textContent = initialDonationPriceItems.toFixed(2);
//             });
//         });
//     });

//     // التعامل مع تغيير الكميات داخل المودال للعناصر
//     document.addEventListener('input', function (event) {
//         if (event.target.matches('input[type="number"]')) {

//             // تأكد من أن المدخل هو لعنصر وليس للأموال
//             if (event.target.closest('.items-modal')) { // تحقق من أن المدخل موجود داخل مودال العناصر
//                 updateDonationPriceItems(event.target);
//             }
//         }
//     });

//     function updateDonationPriceItems(input) {
//         let totalDeducted = 0;

//         // حساب المجموع
//         document.querySelectorAll('.items-modal input[type="number"]').forEach(function (input) {
//             let row = input.closest('tr');
//             if (row) {
//                 let itemPrice = parseFloat(row.dataset.itemPrice) || 0;
//                 let quantity = parseFloat(input.value) || 0;
//                 totalDeducted += itemPrice * quantity;
//             }
//         });

//         // تحقق من أن التبرع لا يتجاوز المبلغ الأصلي
//         if (totalDeducted > initialDonationPriceItems) {
//             alert('التبرع بالعناصر يتجاوز المبلغ المطلوب!');
//             input.value = 0; // تعيين القيمة إلى 0
//         }

//         // تحديث سعر التبرع المتبقي
//         let newDonationPrice = initialDonationPriceItems - totalDeducted;

//         if (!isNaN(newDonationPrice) && newDonationPrice >= 0) {
//             document.querySelectorAll('.donation-price').forEach(function (priceElement) {
//                 priceElement.textContent = newDonationPrice.toFixed(2);
//             });
//         }
//     }

//     // التعامل مع فتح المودال للأموال
//     document.querySelectorAll('[data-bs-toggle="modal"][data-bs-target^="#donationTransferPrice_"]').forEach(function (button) {
//         button.addEventListener('click', function () {
//             let modal = document.querySelector(button.getAttribute('data-bs-target'));
//             let donationPriceElement = modal.querySelector('.donation-money');

//             // تعيين السعر الأصلي عند فتح المودال
//             initialDonationPriceMoney = parseFloat(donationPriceElement.dataset.initialDonation) || 0;

//             // إعادة تعيين جميع المدخلات داخل المودال
//             modal.querySelectorAll('input.price-input').forEach(function (input) {
//                 input.value = 0; // إعادة تعيين القيمة إلى 0
//             });

//             // تحديث السعر بعد إعادة تعيين المدخلات
//             document.querySelectorAll('.donation-money').forEach(function (priceElement) {
//                 priceElement.textContent = initialDonationPriceMoney.toFixed(2);
//             });
//         });
//     });

//     // التعامل مع تغيير الكميات داخل المودال للأموال
//     document.addEventListener('input', function (event) {
//         if (event.target.matches('input.price-input')) {

//             // تأكد من أن المدخل هو للأموال وليس للعناصر
//             if (event.target.closest('.money-modal')) { // تحقق من أن المدخل موجود داخل مودال الأموال
//                 updateDonationPriceMoney(event.target);
//             }
//         }
//     });

//     function updateDonationPriceMoney(input) {
//         let enteredValue = parseFloat(input.value) || 0;
//         let totalDeducted = 0;

//         // حساب المجموع
//         document.querySelectorAll('.money-modal input.price-input').forEach(function (input) {
//             let value = parseFloat(input.value) || 0;
//             totalDeducted += value;
//         });

//         // تحقق من أن التبرع لا يتجاوز المبلغ الأصلي
//         if (totalDeducted > initialDonationPriceMoney) {
//             alert('المبلغ المتبرع به يتجاوز المبلغ المطلوب!');
//             input.value = 0; // تعيين القيمة إلى 0
//         }

//         // حساب السعر المتبقي
//         let newDonationPrice = initialDonationPriceMoney - totalDeducted;

//         // تحديث قيمة التبرع المتبقية
//         if (!isNaN(newDonationPrice) && newDonationPrice >= 0) {
//             document.querySelectorAll('.donation-money').forEach(function (priceElement) {
//                 priceElement.textContent = newDonationPrice.toFixed(2);
//             });
//         }
//     }
// });

