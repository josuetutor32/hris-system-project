<?php

    include('server.php');

    session_start(); // Start the session

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Handle login logic and database connection here
        $username = $_POST['username'];
        $password = $_POST['password'];

        try {
            // Prepare and execute a query to select the user based on the provided username
            $stmt = $pdo->prepare("SELECT username, password, role FROM users WHERE username = :username");
            $stmt->bindParam(':username', $username);
            $stmt->execute();

            $userData = $stmt->fetch();

            if ($userData) {
                $dbUsername = $userData['username'];
                $dbPassword = $userData['password'];
                $userRole = $userData['role'];
                

                if (password_verify($password, $dbPassword)) {
                    // Password is correct
                    $_SESSION['username'] = $dbUsername;
                    $_SESSION['role'] = $userRole;

                    // Fetch user ID
                    $userIdStmt = $pdo->prepare("SELECT id FROM users WHERE username = :username");
                    $userIdStmt->bindParam(':username', $dbUsername);
                    $userIdStmt->execute();
                    $userId = $userIdStmt->fetchColumn();

                    // Insert login record with user ID
                    $insertLoginStmt = $pdo->prepare("INSERT INTO user_login_logout (user_id, username, login_time) VALUES (:user_id, :username, NOW())");
                    $insertLoginStmt->bindParam(':user_id', $userId);
                    $insertLoginStmt->bindParam(':username', $username);
                    $insertLoginStmt->execute();

                    if ($userRole === "admin") {
                        // Redirect the admin to the admin dashboard
                        header("Location: admin_dashboard.php");
                    } else {
                        // Redirect regular users to the user dashboard
                        header("Location: user_dashboard.php");
                    }

                    $result = [
                        'success' => true,
                        'redirect' => $redirect,
                    ];
                    
                    header('Content-Type: application/json');
                    echo json_encode($result);
                    exit();
                    
                } else {
                    // Password is incorrect
                    $error_message = "Invalid password. Please try again.";
                }
            } else {
                // User with the provided username does not exist
                $error_message = "User not found. Please try again.";
            }
        } catch (PDOException $e) {
            $error_message = "Database Error: " . $e->getMessage();
        }
    }

?>