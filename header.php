<header>
    <div>
        <a href="<?php echo $role === 'admin' ? 'admin_dashboard.php' : 'user_dashboard.php'; ?>">Logo</a>
        <input type="search" name="search" id="search" placeholder="Search">
    </div>
    <div>
        <img style="width: 30px; height:30px; border-radius:50%;" src="<?php echo $user['profileImage'] ?>" alt="<?php echo $username ?>">
        <form id="logoutForm" action="logout.php" method="post">
            <button type="submit" class="showLogoutMessage" id="logout" name="logout">logout</button>
        </form>
    </div>
</header>
