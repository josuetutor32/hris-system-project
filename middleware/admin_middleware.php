<?php
    // Include your database connection file
    include('server.php');

    // Check if the user is not logged in; if so, redirect to the login page
    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit();
    }

    // Get the username and role from the session
    $username = $_SESSION['username'];
    $role = $_SESSION['role'];

    // Fetch user ID
    $userIdStmt = $pdo->prepare("SELECT id FROM users WHERE username = :username");
    $userIdStmt->bindParam(':username', $username);
    $userIdStmt->execute();
    $userId = $userIdStmt->fetchColumn();

    // Check if the user is not an admin; if so, display an error message
    if ($role !== "admin") {
        echo "You are not authorized to access this page.";
        exit();
    }

    // Logout logic
    if (isset($_POST['logout'])) {
        // Update logout time for the specific user
        $updateLogoutStmt = $pdo->prepare("UPDATE user_login_logout SET logout_time = NOW() WHERE user_id = :user_id AND logout_time IS NULL");
        $updateLogoutStmt->bindParam(':user_id', $userId);
        $updateLogoutStmt->execute();

        // Clear the session variables and redirect to the login page
        session_unset();
        session_destroy();
        header("Location: login.php");
        exit();
    }

    // Fetch all users' data from the database
    $stmt = $pdo->prepare("SELECT employeeId, username, role, registration_date, profileImage FROM users WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

?>