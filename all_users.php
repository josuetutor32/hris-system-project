<?php
// Include your database connection file
session_start();
include('server.php');
include('./middleware/admin_middleware.php');

// Fetch the logged-in user data
$username = $_SESSION['username'];
$role = $_SESSION['role'];

// Check if the logged-in user is an admin
$isAdmin = ($role === 'admin');

// Fetch all users from the database
$stmt = $pdo->prepare("SELECT employeeId, username, role, registration_date, profileImage FROM users");
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Users</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div>
        <?php include('header.php'); ?>
        <?php include('menu_nav.php'); ?>

        <div class="admin-main-content">
            <div class="member-wrapper">
                <div class="add-new-button-container">
                    <h2>Members</h2>
                    <?php if ($isAdmin): ?>
                        <button><a href="add_employee.php">Add New</a></button>
                    <?php endif; ?>
                </div>
                <div class="users-data">
                    <table>
                        <tr>
                            <th>Employee ID</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Creation Date</th>
                        </tr>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?php echo $user['employeeId']; ?></td>
                                <td><?php echo $user['username']; ?></td>
                                <td><?php echo $user['role']; ?></td>
                                <td><?php echo $user['registration_date']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
