document.addEventListener("DOMContentLoaded", function() {
    // Function to handle FAQ toggles
    const setupFaqToggle = () => {
        const faqItems = document.querySelectorAll('.faq-list li');

        faqItems.forEach(item => {
            item.addEventListener('click', () => {
                const answer = item.querySelector('.answer');
                
                // Check if answer is already expanded
                if (answer.classList.contains('show')) {
                    answer.style.maxHeight = 200;
                    answer.classList.remove('show');
                } else {
                    // Use scrollHeight to expand to the full height of the answer
                    answer.style.maxHeight = answer.scrollHeight + 'px';
                    answer.classList.add('show');
                }
            });
        });
    };

    setupFaqToggle();
});