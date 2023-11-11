<?php
    include('./middleware/addEmployee_middleware.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div>
        <?php include('header.php'); ?>
        <?php include('menu_nav.php'); ?>

        <div class="admin-main-content">
            <div>
                <h1>Add New Employee</h1>
                <form class="add-form" action="add_employee.php" method="post">
                    <div>
                        <label for="employee_name">Employee Name</label>
                        <input type="text" autofocus name="employee_name" required>
                    </div>

                    <div>
                        <label for="employeeId">Employee ID</label>
                        <input type="text" name="employeeId" required>
                    </div>

                    <div>
                        <label for="employee_address">Address</label>
                        <input type="text" name="employee_address" required>
                    </div>

                    <div>
                        <label for="employee_contact_number">Contact Number</label>
                        <input type="text" name="employee_contact_number" required>
                    </div>

                    <div>
                        <label for="employee_birthday">Birthday</label>
                        <input type="date" name="employee_birthday" required>
                    </div>

                    <div>
                        <button type="submit">Submit</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</body>
</html>
