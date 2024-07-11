<?php

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}

// Fetch the full name from the result
$username = $_SESSION['username'];
$result = $conn->query("SELECT full_name FROM user_table WHERE user_name = '$username'");

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $full_name = $row['full_name'];
} else {
    $full_name = "Unknown";
}

$result_stud = $conn->query("SELECT * FROM student");
$result_course = $conn->query("SELECT * FROM course");
$result_enroll = $conn->query("SELECT * FROM student_courses");
$result_user = $conn->query("SELECT * FROM user_table");
?>