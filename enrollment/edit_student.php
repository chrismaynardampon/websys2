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
    <title>Edit Student</title>
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
        <h2>Edit Student</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <input type="hidden" name="student_code" value="<?php echo $row['student_code']; ?>">
            </div>
            <div class="form-group">
                <label for="first_name">First Name:</label>
                <input type="text" name="first_name" value="<?php echo $row['first_name']; ?>" required>
            </div>
            <div class="form-group">
                <label for="last_name">Last Name:</label>
                <input type="text" name="last_name" value="<?php echo $row['last_name']; ?>" required>
            </div>
            <div class="form-group">
                <label for="programme">Programme:</label>
                <input type="text" id="programme" name="programme" value="<?php echo $row['programme']; ?>" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Update Student">
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
        <a href="students.php" class="btn-back">Back to Students</a>
    </div>
    
</body>
</html>
