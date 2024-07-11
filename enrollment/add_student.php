<?php
session_start();
require_once('db.php');
include('operations.php');

function getInitials($fullName) {
    $initials = '';
    $words = explode(' ', $fullName);
    foreach ($words as $word) {
        if (strlen($word) > 0) {
            $initials .= strtolower($word[0]);
        }
    }
    return $initials;
}

$student_code = $first_name = $last_name = $programme = '';
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = htmlspecialchars($_POST['first_name']);
    $last_name = htmlspecialchars($_POST['last_name']);
    $programme = htmlspecialchars($_POST['programme']);
    
    $currentYear = date("Y");
    $first_name_initials = getInitials($first_name);
    $student_code = "AdDU" . $first_name_initials . $last_name . $currentYear;

    if (empty($first_name)) {
        $errors[] = "First Name is required";
    }
    if (empty($last_name)) {
        $errors[] = "Last Name is required";
    }
    if (empty($programme)) {
        $errors[] = "Programme is required";
    }

    if (empty($errors)) {
        $sql_insert = "INSERT INTO student (student_code, first_name, last_name, programme)
                       VALUES ('$student_code', '$first_name', '$last_name', '$programme')";

        if ($conn->query($sql_insert) === TRUE) {
            header("Location: students.php");
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
    <title>Add Student</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="topbar">
        <div>
            <h2><a href="menu.php"><?php echo $full_name; ?></a></h2>
        </div>
        <div>
            <ul>
                <li><a href="enroll.php">Enroll</a></li>
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
    <div class="forms-container add-stud">
        <div class="container">
            <h2>New Student</h2>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-group">
                    <label for="first_name">First Name:</label>
                    <input type="text" id="first_name" name="first_name" value="<?php echo $first_name; ?>" required>
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name:</label>
                    <input type="text" id="last_name" name="last_name" value="<?php echo $last_name; ?>" required>
                </div>
                <div class="form-group">
                    <label for="programme">Programme:</label>
                    <input type="text" id="programme" name="programme" value="<?php echo $programme; ?>" required>
                </div>
                <div class="form-group">
                    <input type="submit" value="Add Student">
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
    </div>
</body>
</html>
