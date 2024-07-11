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
    session_destroy();
    header("Location: login.php");
    exit();
}

$result_stud = $conn->query("SELECT * FROM student");
$result_course = $conn->query("SELECT * FROM course");
$result_enroll = $conn->query("SELECT * FROM student_courses");
$result_user = $conn->query("SELECT * FROM user_table");

//enroll
$student_code = $course_number = '';
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['selected_student']) && isset($_POST['selected_course'])) {
    $student_code = htmlspecialchars($_POST['selected_student']);
    $course_number = htmlspecialchars($_POST['selected_course']);

    if (empty($student_code)) {
        $errors[] = "Student Code is required";
    }
    if (empty($course_number)) {
        $errors[] = "Course Number is required";
    }

    if (empty($errors)) {
        $check_sql = "SELECT * FROM student_courses WHERE student_code = ? AND course_number = ?";
        $check_stmt = $conn->prepare($check_sql);
        $check_stmt->bind_param("ss", $student_code, $course_number);
        $check_stmt->execute();
        $result = $check_stmt->get_result();

        if ($result->num_rows > 0) {
            $errors[] = "This student is already enrolled in this course.";
        } else {
            $stmt = $conn->prepare("INSERT INTO student_courses (student_code, course_number) VALUES (?, ?)");
            $stmt->bind_param("ss", $student_code, $course_number);

            if ($stmt->execute() === TRUE) {
                if (isset($_POST['current_page'])) {
                    header("Location: menu.php");
                } else {
                    header("Location: enroll.php");
                }
                exit();
            } else {
                $errors[] = "Error: " . $stmt->error;
            }
            $stmt->close();
        }
        $check_stmt->close();
    }
}

// Display errors if any
if (!empty($errors)) {
    foreach ($errors as $error) {
        echo "<script>showError('".htmlspecialchars($error)."');</script>";
    }
}
?>