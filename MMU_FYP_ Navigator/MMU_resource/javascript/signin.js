document.addEventListener("DOMContentLoaded", function() {
    // Function to handle the sign-up and sign-in panel toggle
    const setupSignUpInToggle = () => {
        const signUpButton = document.getElementById('signUp');
        const signInButton = document.getElementById('signIn');
        const container = document.getElementById('container');

        if (signUpButton && signInButton && container) {
            signUpButton.addEventListener('click', () => {
                container.classList.add("right-panel-active");
            });

            signInButton.addEventListener('click', () => {
                container.classList.remove("right-panel-active");
            });
        }
    };

    const showAlert = (message) => {
        alert(message);
    };

    // Function for client-side validation
    const validateSignUpForm = () => {
        const signupForm = document.getElementById('signup-form');
        signupForm.addEventListener('submit', (event) => {
            const username = signupForm.username.value.trim();
            const email = signupForm.email.value.trim();
            const password = signupForm.password.value.trim();
            const confirmPassword = signupForm.confirm_password.value.trim();

            if (password.length < 6) {
                showAlert('Password should be 6 characters or more');
                event.preventDefault();
                return false;
            }

            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email)) {
                showAlert('Email format is not correct');
                event.preventDefault();
                return false;
            }

            if (password !== confirmPassword) {
                showAlert('Passwords do not match');
                event.preventDefault();
                return false;
            }

            return true;
        });
    };

    const validateSignInForm = () => {
        const signinForm = document.getElementById('signin-form');
        signinForm.addEventListener('submit', (event) => {
            const email = signinForm.email.value.trim();
            const password = signinForm.password.value.trim();

            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email)) {
                showAlert('Email format is not correct');
                event.preventDefault();
                return false;
            }

            return true;
        });
    };

    setupSignUpInToggle();
    validateSignUpForm();
    validateSignInForm();
});
