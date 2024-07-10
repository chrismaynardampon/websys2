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
    <title>Edit Course</title>
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
        <h2>Edit Course</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <input type="hidden" name="course_number" value="<?php echo $row['course_number']; ?>">
            </div>
            <div class="form-group">
                <label for="course_description">Course Description:</label>
                <input type="text" name="course_description" value="<?php echo $row['course_description']; ?>" required>
            </div>
            <div class="form-group">
                <label for="units">Units:</label>
                <input type="text" name="units" value="<?php echo $row['units']; ?>" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Update Course">
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
        <a href="courses.php" class="btn-back">Back to Courses</a>
    </div>
    
</body>
</html>
