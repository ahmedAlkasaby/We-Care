document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');  // Assuming you have a form element
    const itemBtn = document.getElementById('item-btn');
    const priceBtn = document.getElementById('price-btn');
    const itemField = document.querySelector('.item-field');
    const priceField = document.querySelector('.price-field');
    const priceInput = document.getElementById('price-field');
    let currentMode = 'item';  // default mode

    // Initialize visibility based on the active button
    toggleFields();

    // Event listeners for buttons
    itemBtn.addEventListener('click', function () {
        toggleActiveButton(itemBtn, priceBtn);
        currentMode = 'item';  // Set mode to item
        toggleFields();
    });

    priceBtn.addEventListener('click', function () {
        toggleActiveButton(priceBtn, itemBtn);
        currentMode = 'price';  // Set mode to price
        toggleFields();
    });

    function toggleFields() {
        if (currentMode === 'item') {
            itemField.classList.remove('d-none');
            priceField.classList.add('d-none');
            priceInput.setAttribute('disabled', 'true');  // Disable price field
            enableItemFields();  // Enable item fields
        } else {
            priceField.classList.remove('d-none');
            itemField.classList.add('d-none');
            priceInput.removeAttribute('disabled');  // Enable price field
            disableItemFields();  // Disable item fields
        }
    }

    function toggleActiveButton(activeBtn, inactiveBtn) {
        activeBtn.classList.add('active', 'btn-primary');
        activeBtn.classList.remove('btn-secondary');
        inactiveBtn.classList.remove('active', 'btn-primary');
        inactiveBtn.classList.add('btn-secondary');
    }

    function enableItemFields() {
        const itemInputs = document.querySelectorAll('.item-field input, .item-field select');
        itemInputs.forEach(input => input.removeAttribute('disabled'));
    }

    function disableItemFields() {
        const itemInputs = document.querySelectorAll('.item-field input, .item-field select');
        itemInputs.forEach(input => input.setAttribute('disabled', 'true'));
    }

    // Prevent submitting disabled fields
    form.addEventListener('submit', function (e) {
        // Ensure that only active fields are submitted
        if (currentMode === 'item') {
            priceInput.setAttribute('disabled', 'true');  // Disable price field if item mode is active
        } else {
            // Disable all item-related inputs if price mode is active
            disableItemFields();
        }
    });
});
