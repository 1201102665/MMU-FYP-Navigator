document.addEventListener("DOMContentLoaded", function() {
    // Function to handle FAQ toggles
    const setupFaqToggle = () => {
        const faqItems = document.querySelectorAll('.faq-list li');

        faqItems.forEach(item => {
            item.addEventListener('click', () => {
                const answer = item.querySelector('.answer');
                if (answer.classList.contains('show')) {
                    answer.style.maxHeight = null;
                    answer.classList.remove('show');
                } else {
                    answer.style.maxHeight = answer.scrollHeight + 'px';
                    answer.classList.add('show');
                }
            });
        });
    };

    setupFaqToggle();
});
