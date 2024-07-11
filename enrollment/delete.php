<?php
session_start();
require_once('db.php');
   
// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// stud
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['student_code'])) {
    $student_code = $_GET['student_code'];

    $sql = "DELETE FROM student WHERE student_code = '$student_code'";

    if ($conn->query($sql) === TRUE) {
        if (isset($_GET['current_page'])) {
            header("Location: menu.php");
        } else {
            header("Location: students.php");
        }
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

//course
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['course_number'])) {
    $course_number = $_GET['course_number'];

    $sql = "DELETE FROM course WHERE course_number = '$course_number'";

    if ($conn->query($sql) === TRUE) {
        if (isset($_GET['current_page'])){
            header("Location: menu.php");
        } else {
            header("Location: courses.php");
        }
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

//users
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['user_name'])) {
    $user_name = $_GET['user_name'];

    $sql = "DELETE FROM user_table WHERE user_name = '$user_name'";

    if ($conn->query($sql) === TRUE) {
        if (isset($_GET['current_page'])){
            header("Location: menu.php");
        } else {
            header("Location: users.php");
        }
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
?>
