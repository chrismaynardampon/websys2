<?php
session_start();
require_once('db.php');
include_once('sess.php');

$sql_stud = "SELECT * FROM student";
$result_stud = $conn->query($sql_stud);
$sql_course = "SELECT * FROM course";
$result_course = $conn->query($sql_course);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .container2 {
            margin-left: 220px;
            padding: 20px;
        }
    </style>
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
<div>
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
                            <a class='btn-delete' href='delete.php?student_code=".$row["student_code"]."' onclick='return confirm(\"Are you sure you want to delete this student?\");'>Delete</a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>0 results</td></tr>";
            }
            ?>
        </table>
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
                            <a class='btn-delete' href='delete.php?course_number=".$row["course_number"]."' onclick='return confirm(\"Are you sure you want to delete this course?\");'>Delete</a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>0 results</td></tr>";
            }
            ?>
        </table>
    </div>
    </div>
</body>
</html>
