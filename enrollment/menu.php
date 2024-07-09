<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Menu</title>
</head>
<body>
    <h2>Welcome, <?php echo $_SESSION['username']; ?></h2>
    <ul>
        <li><a href="students.php">Students</a></li>
        <li><a href="courses.php">Courses</a></li>
        <li><a href="users.php">Users</a></li>
    </ul>
</body>
</html>
