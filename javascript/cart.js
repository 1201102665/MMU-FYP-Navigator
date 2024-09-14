document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('.cart-checkbox');
    const itemCountElement = document.getElementById('item-count');
    const totalPriceElement = document.getElementById('total-price');
    const selectAllBtn = document.querySelector('.select-all-btn'); // Select the button

    function updateSummary() {
        let totalItems = 0;
        let totalPrice = 0;
        checkboxes.forEach(checkbox => {
            if (checkbox.checked) {
                totalItems++;
                totalPrice += parseFloat(checkbox.getAttribute('data-price'));
            }
        });
        itemCountElement.textContent = totalItems;
        totalPriceElement.textContent = totalPrice.toFixed(2);
    }

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateSummary);
    });

    // Add event listener to "Select All" button
    selectAllBtn.addEventListener('click', function() {
        checkboxes.forEach(checkbox => {
            checkbox.checked = true;
        });
        updateSummary(); // Update the summary after selecting all items
    });

    updateSummary(); // Initialize the summary on page load
});