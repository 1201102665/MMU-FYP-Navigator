document.addEventListener("DOMContentLoaded", function() {
    // Function to handle the profile dropdown menu
    const setupProfileDropdown = () => {
        const profileDropdown = document.querySelector('.profile-dropdown span');
        if (profileDropdown) {
            profileDropdown.addEventListener('click', function() {
                this.parentElement.classList.toggle('show');
            });

            document.addEventListener('click', function(event) {
                if (!profileDropdown.contains(event.target)) {
                    profileDropdown.parentElement.classList.remove('show');
                }
            });
        }
    };

    setupProfileDropdown();
});
