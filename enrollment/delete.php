<?php
session_start();
require_once('db.php');

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['student_code'])) {
    $student_code = $_GET['student_code'];

    $sql = "DELETE FROM student WHERE student_code = '$student_code'";

    if ($conn->query($sql) === TRUE) {
        header("Location: students.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['course_number'])) {
    $course_number = $_GET['course_number'];

    $sql = "DELETE FROM course WHERE course_number = '$course_number'";

    if ($conn->query($sql) === TRUE) {
        header("Location: courses.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
?>
