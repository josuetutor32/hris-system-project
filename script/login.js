document.addEventListener('DOMContentLoaded', function () {

    const loginForm = document.querySelector('#loginForm');

    loginForm.addEventListener('submit', async function (event) {
        event.preventDefault();

        const username = document.querySelector('#username').value;
        const password = document.querySelector('#password').value;

        try {
            const response = await fetch('login.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    username: username,
                    password: password,
                }),
            });

            if (response.ok) {
                const result = await response.json(); // Assuming your server returns JSON
                if (result.success) {
                    // Successful login
                    window.location.href = result.redirect;
                } else {
                    // Display error message
                    console.error(result.message);
                }
            } else {
                console.error('Network response was not ok');
            }
        } catch (error) {
            console.error('There was a problem with the fetch operation:', error);
        }
    });
});
