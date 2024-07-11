<?php
session_start();
require('db.php');
include('operations.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses</title>
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
                echo "<tr><td colspan='4'>0 results</td></tr>";
            }
            ?>
        </table>
        <p><a href="add_course.php" class="btn-addStud">Add New Course</a></p>
    </div>
    </div>
</body>
</html>
