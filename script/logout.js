const logoutButton = document.querySelector('#logout');

logoutButton.addEventListener('click', async () => {
    try {
        const response = await fetch('logout.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                logout: true,
            }),
        });

        if (response.ok) {
            const result = await response.json(); // Assuming your server returns JSON
            if (result.success) {
                // Successful logout
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
