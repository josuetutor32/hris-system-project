<?php
    session_start();
    include('./middleware/admin_middleware.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div>
        <?php include('header.php'); ?>
        <?php include('menu_nav.php'); ?>
        
        <div class="main-container">


            <div class="admin-main-content">
                <h2>Welcome to your Dashboard</h2>
            </div>
        </div>
    </div>
    <script src="logout.js"></script>
</body>
</html>
