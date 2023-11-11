const showLoadingMessage = document.querySelector(".showLoadingMessage");
showLoadingMessage.addEventListener("click", () => {
    const loading = document.querySelector('#loading');
    loading.textContent = "Logging in...";

    setTimeout(function () {
        document.querySelector('#loginForm').submit();
    }, 3000); // 3-second delay before form submission
});

// Prevent the default form submission
const loginForm = document.querySelector("#loginForm");
loginForm.addEventListener("submit", function (event) {
    event.preventDefault();
});