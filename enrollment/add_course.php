<?php
session_start();
require_once('db.php');
include_once('sess.php');

$course_number = $course_description = $units = '';
$errors = [];

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $course_number = htmlspecialchars($_POST['course_number']);
    $course_description = htmlspecialchars($_POST['course_description']);
    $units = htmlspecialchars($_POST['units']);

    // Basic validation - check if required fields are empty
    if (empty($course_number)) {
        $errors[] = "Course Number is required";
    }
    if (empty($course_description)) {
        $errors[] = "Course Description is required";
    }
    if (empty($units)) {
        $errors[] = "Last Name is required";
    }

    if (empty($errors)) {
        $sql_insert = "INSERT INTO course (course_number, course_description, units) 
                       VALUES ('$course_number', '$course_description', '$units')";

        if ($conn->query($sql_insert) === TRUE) {
            header("Location: courses.php");
            exit();
        } else {
            $errors[] = "Error: " . $sql_insert . "<br>" . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Course</title>
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
        <h2>Add New Course</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="course_number">Course Number:</label>
                <input type="text" id="course_number" name="course_number" value="<?php echo $course_number; ?>" required>
            </div>
            <div class="form-group">
                <label for="course_description">Course Description:</label>
                <input type="text" id="course_description" name="course_description" value="<?php echo $course_description; ?>" required>
            </div>
            <div class="form-group">
                <label for="units">Units:</label>
                <input type="text" id="units" name="units" value="<?php echo $units; ?>" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Add Course">
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
