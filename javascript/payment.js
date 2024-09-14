document.addEventListener("DOMContentLoaded", function() {
    // Function to handle payment card input formatting
    const setupPaymentFormatting = () => {
        const cardNumberInput = document.getElementById('card_number');
        const cardExpiryInput = document.getElementById('card_expiry');
        const cardCvcInput = document.getElementById('card_cvc');

        if (cardNumberInput) {
            cardNumberInput.addEventListener('input', (e) => {
                let value = e.target.value.replace(/\D/g, '').substring(0, 16);
                value = value.replace(/(\d{4})(?=\d)/g, '$1 ');
                e.target.value = value;
            });
        }

        if (cardExpiryInput) {
            cardExpiryInput.addEventListener('input', (e) => {
                let value = e.target.value.replace(/\D/g, '').substring(0, 4);
                if (value.length >= 3) {
                    value = value.replace(/(\d{2})(\d{2})/, '$1/$2');
                }
                e.target.value = value;
            });
        }

        if (cardCvcInput) {
            cardCvcInput.addEventListener('input', (e) => {
                e.target.value = e.target.value.replace(/\D/g, '').substring(0, 3);
            });
        }
    };

    setupPaymentFormatting();
});
