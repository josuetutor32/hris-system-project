<?php
    session_start();
    include('./middleware/user_middleware.php');
    include('./middleware/salary_rate_middleware.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div>
        <?php include('header.php'); ?>

        <div class="admin-main-content">
            <div id="loading"></div>
            <div class="admin-data-wrapper">
                <div class="data-wrapper">
                    <div>
                        <h3>Employee ID:</h3>
                        <h3><?php echo $user['employeeId']; ?></h3>
                    </div>
                    <div>
                        <h3>Username</h3>
                        <h3><?php echo $user['username']; ?></h3>
                    </div>
                    <div>
                        <h3>Role:</h3>
                        <h3><?php echo $user['role']; ?></h3>
                    </div>
                    <div>
                        <h3>Total Working Hours</h3>
                        <h3><?php echo $totalOfHours; ?> hours</h3>
                    </div>
                    <div>
                        <h3>Date Created</h3>
                        <h3><?php echo $user['registration_date']; ?> hours</h3>
                    </div>
                    <div>
                        <h3>Profile Image</h3>
                        <img src="<?php echo $user['profileImage']; ?>"></h3>
                    </div>
                </div>
            </div>
    </div>
    <script>
        const showLogoutMessage = document.querySelector(".showLogoutMessage");
        showLogoutMessage.addEventListener("click", () => {
            const loading = document.querySelector('#loading');
            loading.textContent = "Logging out...";

            setTimeout(function () {
                document.querySelector('#logoutForm').submit();
            }, 1000); // 1-second delay before form submission
        });
    </script>
    <script src="logout.js"></script>
</body>
</html>
