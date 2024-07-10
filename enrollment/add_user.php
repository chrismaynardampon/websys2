<?php
session_start();
require_once('db.php');
include_once('sess.php');

$user_name = $fullname = $password = '';
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_name = htmlspecialchars($_POST['user_name']);
    $fullname = htmlspecialchars($_POST['full_name']);
    $password = htmlspecialchars($_POST['password']);

    if (empty($user_name)) {
        $errors[] = "User Name is required";
    }
    if (empty($fullname)) {
        $errors[] = "Full Name is required";
    }
    if (empty($password)) {
        $errors[] = "Password is required";
    }

    if (empty($errors)) {
        // Hash the password using PHP's password_hash() function
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $sql_insert = "INSERT INTO user_table (user_name, full_name, password) 
                       VALUES ('$user_name', '$fullname', '$hashed_password')";

        if ($conn->query($sql_insert) === TRUE) {
            header("Location: users.php");
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
    <title>Add User</title>
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
        <h2>Add New User</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="user_name">User Name:</label>
                <input type="text" id="user_name" name="user_name" value="<?php echo $user_name; ?>" required>
            </div>
            <div class="form-group">
                <label for="full_name">Full Name:</label>
                <input type="text" id="full_name" name="full_name" value="<?php echo $fullname; ?>" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" value="<?php echo $password; ?>" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Add User">
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
