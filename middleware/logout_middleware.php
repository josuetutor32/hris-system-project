<?php

    session_start(); // Start the session

    // Include your database connection file
    include('server.php');

    // Logout logic
    if (isset($_POST['logout'])) {
        // Fetch user ID
        $username = $_SESSION['username'];
        $userIdStmt = $pdo->prepare("SELECT id FROM users WHERE username = :username");
        $userIdStmt->bindParam(':username', $username);
        $userIdStmt->execute();
        $userId = $userIdStmt->fetchColumn();

        // Update logout time for the specific user
        $updateLogoutStmt = $pdo->prepare("UPDATE user_login_logout SET logout_time = NOW() WHERE user_id = :user_id AND logout_time IS NULL");
        $updateLogoutStmt->bindParam(':user_id', $userId);
        $updateLogoutStmt->execute();

        // Clear the session variables and redirect to the login page
        session_unset();
        session_destroy();

        $response = [
            'success' => true,
            'redirect' => 'login.php',
        ];

        
        header("Location: login.php");
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }

?>