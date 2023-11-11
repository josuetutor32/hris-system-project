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

// Fetch all users from the database
$stmt = $pdo->prepare("SELECT employeeId, username, role, registration_date, profileImage FROM users");
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>