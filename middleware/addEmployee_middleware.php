<?php

    session_start();

    include('server.php');

    // Check if the user is not logged in; if so, redirect to the login page
    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit();
    }

    // Get the username and role from the session
    $username = $_SESSION['username'];
    $role = $_SESSION['role'];

    // Get the username and role from the session
    $username = $_SESSION['username'];
    $role = $_SESSION['role'];

    // Check if the user is not an admin; if so, display an error message
    if ($role !== "admin") {
        echo "You are not authorized to access this page.";
        exit();
    }

    // Fetch all users' data from the database
    $stmt = $pdo->prepare("SELECT employeeId, username, role, registration_date, profileImage FROM users WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Handle form submission
        $employeeId = $_POST['employeeId'];
        $employeeName = $_POST['employee_name'];
        $employeeAddress = $_POST['employee_address'];
        $employeeContactNumber = $_POST['employee_contact_number'];
        $employeeBirthday = $_POST['employee_birthday'];

        // Include your database connection file
        include('server.php');

        // Fetch admin user data
        $adminQuery = "SELECT * FROM users WHERE username = :username";
        $adminStmt = $pdo->prepare($adminQuery);
        $adminStmt->bindParam(':username', $_SESSION['username'], PDO::PARAM_STR);
        $adminStmt->execute();
        $adminData = $adminStmt->fetch(PDO::FETCH_ASSOC);

        // Insert the new employee into the database
        $insertEmployeeQuery = "INSERT INTO employees (admin_id, employeeId, name, address, contact_number, birthday, created_at) 
                            VALUES (:admin_id, :employeeId, :name, :address, :contact_number, :birthday, NOW())";
        $insertEmployeeStmt = $pdo->prepare($insertEmployeeQuery);
        $insertEmployeeStmt->bindParam(':admin_id', $adminData['id'], PDO::PARAM_INT);
        $insertEmployeeStmt->bindParam(':employeeId', $employeeId, PDO::PARAM_INT);
        $insertEmployeeStmt->bindParam(':name', $employeeName, PDO::PARAM_STR);
        $insertEmployeeStmt->bindParam(':address', $employeeAddress, PDO::PARAM_STR);
        $insertEmployeeStmt->bindParam(':contact_number', $employeeContactNumber, PDO::PARAM_STR);
        $insertEmployeeStmt->bindParam(':birthday', $employeeBirthday, PDO::PARAM_STR);

        if ($insertEmployeeStmt->execute()) {
            echo "Employee added successfully.";
        } else {
            echo "Error adding employee.";
        }
    }

?>