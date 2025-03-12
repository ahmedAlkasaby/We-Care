document.addEventListener('DOMContentLoaded', function () {
    const donateMoneyBtn = document.getElementById('donateMoney');
    const donateItemsBtn = document.getElementById('donateItems');
    const moneyDonationSection = document.getElementById('moneyDonationSection');
    const itemsDonationSection = document.getElementById('itemsDonationSection');
    const priceInput = document.querySelector('input[name="price"]'); // الحقل الخاص بالتبرع المالي
    const itemInputs = document.querySelectorAll('#itemsDonationSection input'); // الحقول الخاصة بالتبرع بالعناصر


    // Function to toggle active class between the two buttons
    function toggleActiveButton(activeBtn, inactiveBtn) {
        activeBtn.classList.add('btn-outline-primary');   // إضافة الفئة النشطة
        activeBtn.classList.remove('btn-active'); // إزالة الفئة "outline" من الزر النشط
        inactiveBtn.classList.remove('btn-outline-primary'); // إزالة الفئة النشطة من الزر الآخر
        inactiveBtn.classList.add('btn-active'); // إعادة الفئة "outline" إلى الزر الآخر
    }

    // Function to disable all item-related inputs
    function disableItemFields() {
        itemInputs.forEach(input => input.setAttribute('disabled', 'true'));
    }

    // Function to enable all item-related inputs
    function enableItemFields() {
        itemInputs.forEach(input => input.removeAttribute('disabled'));
    }

    // عند الضغط على زر تبرع بالمال
    donateMoneyBtn.addEventListener('click', function () {
        moneyDonationSection.style.display = 'block';
        itemsDonationSection.style.display = 'none';
        toggleActiveButton(donateMoneyBtn, donateItemsBtn);  // تفعيل زر تبرع بالمال
        priceInput.removeAttribute('disabled'); // تمكين حقل السعر
        disableItemFields(); // تعطيل حقول التبرع بالعناصر
    });

    // عند الضغط على زر تبرع بعناصر
    donateItemsBtn.addEventListener('click', function () {
        moneyDonationSection.style.display = 'none';
        itemsDonationSection.style.display = 'block';
        toggleActiveButton(donateItemsBtn, donateMoneyBtn);
        priceInput.setAttribute('disabled', 'true'); // تعطيل حقل السعر
        enableItemFields(); // تمكين حقول التبرع بالعناصر  // تفعيل زر تبرع بالعناصر
    });
});
