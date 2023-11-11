<?php
    include('./middleware/login_middleware.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form id="loginForm" action="login.php" method="post">
        <h2>Login</h2>
        <div id="loading"></div>
        <?php if (isset($error_message)) { ?>
            <p style="color: red;"><?php echo $error_message; ?></p>
        <?php } ?>
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="button" class="showLoadingMessage" value="Login">Login</button>
        <a href="register.php">Register</a>
    </form>

    <script src="./script/script.js"></script>
    <script src="./script/login.js"></script>
</body>
</html>
