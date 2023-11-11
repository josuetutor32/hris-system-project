<?php
    include('./middleware/logout_middleware.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Logout</title>
</head>
<body>
    <h3>Logging out...</h3>

    <script>
        // Add a JavaScript timeout to delay the redirection
        setTimeout(function() {
            window.location.href = "login.php";
        }, 2000); // 3-second delay
    </script>
</body>
</html>
