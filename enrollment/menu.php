<?php
session_start();
require('db.php');
include('operations.php');

$current_page = "menu";
//enroll delete
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['stud_code']) && isset($_GET['course_num'])) {
    $stud_code = $_GET['stud_code'];
    $course_num = $_GET['course_num'];

    $sql = "DELETE FROM student_courses WHERE student_code = '$stud_code' and course_number = '$course_num'";
    if ($conn->query($sql) === TRUE) {
        header("Location: menu.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
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
    <div class="forms-container">
        <div class="container2">
            <h1>Students</h1>
            <table>
                <tr>
                    <th>Student Code</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Programme</th>
                    <th>Actions</th>
                </tr>
                <?php
                if ($result_stud->num_rows > 0) {
                    while($row = $result_stud->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>".$row["student_code"]."</td>";
                        echo "<td>".$row["first_name"]."</td>";
                        echo "<td>".$row["last_name"]."</td>";
                        echo "<td>".$row["programme"]."</td>";
                        echo "<td>
                            <a class='btn-edit' href='edit_student.php?student_code=".$row["student_code"]."'>Edit</a> |
                            <a class='btn-delete' href='delete.php?student_code=".$row["student_code"]."&current_page=".$current_page."' onclick='return confirm(\"Are you sure you want to delete this student?\");'>Delete</a>
                          </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>0 results</td></tr>";
                }
                ?>
            </table>
            <p><a href="add_student.php" class="btn-addStud">Add New Student</a></p>
        </div>

        <div class="container2">
            <h1>Courses</h1>
            <table>
                <tr>
                    <th>Course Number</th>
                    <th>Course Description</th>
                    <th>Units</th>
                    <th>Actions</th>
                </tr>
                <?php
                    if ($result_course->num_rows > 0) {
                        while($row = $result_course->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>".$row["course_number"]."</td>";
                            echo "<td>".$row["course_description"]."</td>";
                            echo "<td>".$row["units"]."</td>";
                            echo "<td>
                                <a class='btn-edit' href='edit_course.php?course_number=".$row["course_number"]."'>Edit</a> |
                                <a class='btn-delete' href='delete.php?course_number=".$row["course_number"]."&current_page=".$current_page."' onclick='return confirm(\"Are you sure you want to delete this course?\");'>Delete</a>
                                </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>0 results</td></tr>";
                    }
                ?>
            </table>
            <p><a href="add_course.php" class="btn-addStud">Add New Course</a></p>
        </div>
        <div class="container2">
            <h1>Enrollments</h1>
            <table>
                <tr>
                    <th>Student Code</th>
                    <th>Course Number</th>
                    <th>Actions</th>
                </tr>
                <?php
                    if ($result_enroll->num_rows > 0) {
                        while($row = $result_enroll->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>".htmlspecialchars($row["student_code"])."</td>";
                            echo "<td>".htmlspecialchars($row["course_number"])."</td>";
                            echo "<td>
                                <a class='btn-delete' href='enroll.php?stud_code=".htmlspecialchars($row["student_code"])."&course_num=".htmlspecialchars($row["course_number"])."&current_page=".htmlspecialchars($current_page)."' onclick='return confirm(\"Are you sure you want to drop this enrollment?\");'>Drop</a>
                                </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>0 results</td></tr>";
                    }
                ?>
            </table>
                <p><a href="enroll.php" class="btn-addStud">Enroll Student</a></p>
        </div>
        <div class="container2"></div>
    </div>
</body>
</html>