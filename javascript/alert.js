document.addEventListener("DOMContentLoaded", function() {
    // Function to show success alert
    const showSuccessAlert = () => {
        if (document.querySelector('.alert.success')) {
            setTimeout(() => {
                document.querySelector('.alert.success').classList.add('alert__active');
            }, 10);

            setTimeout(() => {
                document.querySelector('.alert.success').classList.add('alert__extended');
            }, 500);

            setTimeout(() => {
                const alert = document.querySelector('.alert.success');
                alert.classList.remove('alert__extended');
                setTimeout(() => {
                    alert.classList.remove('alert__active');
                }, 500);
                setTimeout(() => {
                    alert.remove();
                }, 1000);
            }, 5000);
        }
    };

    // Function to show error alert
    const showErrorAlert = () => {
        if (document.querySelector('.alert.error')) {
            setTimeout(() => {
                document.querySelector('.alert.error').classList.add('alert__active');
            }, 10);

            setTimeout(() => {
                document.querySelector('.alert.error').classList.add('alert__extended');
            }, 500);

            setTimeout(() => {
                const alert = document.querySelector('.alert.error');
                alert.classList.remove('alert__extended');
                setTimeout(() => {
                    alert.classList.remove('alert__active');
                }, 500);
                setTimeout(() => {
                    alert.remove();
                }, 1000);
            }, 5000);
        }
    };

    showSuccessAlert();
    showErrorAlert();
});
