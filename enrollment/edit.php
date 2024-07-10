<?php
require_once('db.php');

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

//student

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['student_code'])) {
    $student_code = $_GET['student_code'];

    $sql = "SELECT * FROM student WHERE student_code = '$student_code'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
    } else {
        header("Location: students.php");
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['student_code'])) {
    $student_code = $_POST['student_code'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $programme = $_POST['programme'];

    $sql = "UPDATE student SET first_name = '$first_name', last_name = '$last_name', programme = '$programme' WHERE student_code = '$student_code'";

    if ($conn->query($sql) === TRUE) {
        header("Location: students.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

//course

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['course_number'])) {
    $course_number = $_GET['course_number'];

    $sql = "SELECT * FROM course WHERE course_number = '$course_number'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
    } else {
        header("Location: courses.php");
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['course_number'])) {
    $course_number = $_POST['course_number'];
    $course_description = $_POST['course_description'];
    $units = $_POST['units'];

    $sql = "UPDATE course SET course_description = '$course_description', units = '$units' WHERE course_number = '$course_number'";

    if ($conn->query($sql) === TRUE) {
        header("Location: courses.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

//Users

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['user_name'])) {
    $user_name = $_GET['user_name'];

    $sql = "SELECT * FROM user_table WHERE user_name = '$user_name'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
    } else {
        header("Location: users.php");
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['user_name'])) {
    $user_name = $_POST['user_name'];
    $full_name = $_POST['full_name'];
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $sql = "UPDATE user_table SET full_name = '$full_name', password = '$hashed_password' WHERE user_name = '$user_name'";

    if ($conn->query($sql) === TRUE) {
        header("Location: users.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>
