<?php
session_start();
require_once('db.php');
include_once('sess.php');
include_once('edit.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="sidebar">
        <div>
            <h2><?php echo $full_name; ?></h2>
            <ul>
                <li><a href="students.php">Students</a></li>
                <li><a href="courses.php">Courses</a></li>
                <li><a href="users.php">Users</a></li>
            </ul>
        </div>
        <div class="logout-container">
            <form method="post">
                <input type="submit" name="logout" value="Logout">
            </form>
        </div>
    </div>
    <div class="container">
        <h2>Edit User</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <input type="hidden" name="user_name" value="<?php echo $row['user_name']; ?>">
            </div>
            <div class="form-group">
                <label for="full_name">Full Name:</label>
                <input type="text" name="full_name" value="<?php echo $row['full_name']; ?>" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" value="<?php echo $row['password']; ?>" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Update User">
            </div>
        </form>
        <?php

        if (!empty($errors)) {
            echo '<div class="error-message"><ul>';
            foreach ($errors as $error) {
                echo '<li>' . $error . '</li>';
            }
            echo '</ul></div>';
        }
        ?>
        <a href="users.php" class="btn-back">Back to Users</a>
    </div>
    
</body>
</html>
