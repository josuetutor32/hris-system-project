<?php
    include('server.php');

    session_start(); // Start the session

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Handle registration logic here
        $username = $_POST['username'];
        $password = $_POST['password'];
        $role = $_POST['role']; // Get the selected role
        $employeeId = $_POST['employeeId'];

        try {
            // Check if the username already exists in the database
            $check_query = "SELECT username FROM users WHERE username = :username";
            $check_stmt = $pdo->prepare($check_query);
            $check_stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $check_stmt->execute();

            if ($check_stmt->rowCount() > 0) {
                $error_message = "Username already exists. Please choose a different username.";
            } else {
                // Handle file upload
                $profileImage = $_FILES['profileImage'];  // Use $_FILES instead of $_POST
                $targetDirectory = "uploads/";
                $targetFilePath = $targetDirectory . basename($profileImage['name']);
                move_uploaded_file($profileImage['tmp_name'], $targetFilePath);

                // Hash the password using PHP's password_hash function
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                // Prepare an SQL statement to insert the user data into the 'users' table
                $insert_query = "INSERT INTO users (username, password, role, registration_date, employeeId, profileImage) VALUES (:username, :password, :role, NOW(), :employeeId, :profileImage)";
                $stmt = $pdo->prepare($insert_query);
                $stmt->bindParam(':username', $username, PDO::PARAM_STR);
                $stmt->bindParam(':password', $hashed_password, PDO::PARAM_STR);
                $stmt->bindParam(':role', $role, PDO::PARAM_STR);
                $stmt->bindParam(':employeeId', $employeeId, PDO::PARAM_STR);
                $stmt->bindParam(':profileImage', $targetFilePath, PDO::PARAM_STR);

                if ($stmt->execute()) {
                    // Registration was successful
                    $_SESSION['username'] = $username;
                    $_SESSION['role'] = $role;

                    if ($role === "admin") {
                        // Registration was successful for an admin
                        $success_message = "Admin registration successful! You can now log in as an admin.";
                    } else {
                        // Registration was successful for a regular user
                        $success_message = "User registration successful! You can now log in as a regular user.";
                    }
                } else {
                    // Handle registration failure
                    $error_message = "Registration failed. Please try again.";
                }
            }
        } catch (PDOException $e) {
            $error_message = "Database Error: " . $e->getMessage();
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registration</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form id="registrationForm" action="register.php" method="post" enctype="multipart/form-data">
        <h2>Registration</h2>
        <div id="loading"></div>
        <?php if (isset($success_message)) { // Display success message if it exists ?>
            <p style="color: green;"><?php echo $success_message; ?></p>
        <?php } elseif (isset($error_message)) { // Display error message if it exists ?>
            <p style="color: red;"><?php echo $error_message; ?></p>
        <?php } ?>
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <select id="role" name="role">
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select>
        <input type="text" name="employeeId" placeholder="Employee ID" required>
        <input type="file" name="profileImage" accept="image/*" required>
        <button type="button" value="Register" onclick="showLoadingMessage();">Register</button>
        <a href="login.php">Login</a>
    </form>

    <script>
        function showLoadingMessage() {
            var loading = document.getElementById("loading");
            loading.innerHTML = "Registering...";

            var registerButton = document.querySelector("#registrationForm button");
            registerButton.disabled = true; // Disable the button during the delay

            setTimeout(function() {
                document.getElementById("registrationForm").submit();
            }, 3000); // 3-second delay before form submission
        }
    </script>
</body>
</html>
