<?php
    // Calculate total login time, logout time, and days of work for a specific user
    $username = $_SESSION['username']; // Replace with the actual user ID
    $loginLogoutStmt = $pdo->prepare("SELECT login_time, logout_time FROM user_login_logout WHERE user_id = :user_id");
    $loginLogoutStmt->bindParam(':user_id', $userId);
    $loginLogoutStmt->execute();

    $totalTime = 0;

    while ($row = $loginLogoutStmt->fetch(PDO::FETCH_ASSOC)) {
        $loginTime = strtotime($row['login_time']);
        $logoutTime = strtotime($row['logout_time']);

        // Calculate total time in seconds
        $totalTime +=  ceil($loginTime - $logoutTime) / (60 * 60 * 24) ;
    }
    
    // Convert total login and logout time to whole hours
    $totalOfHours = round(($totalTime) / (60 * 60));
?>
