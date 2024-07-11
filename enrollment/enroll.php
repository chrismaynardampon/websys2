<?php
session_start();
require('db.php');
include('operations.php');
$current_page = "enroll";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enroll</title>
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
                           <input type='radio' name='selected_student' value='".$row["student_code"]."'>
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
                                <input type='radio' name='selected_course' value='".$row["course_number"]."'>
                            </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>0 results</td></tr>";
                    }
                ?>
            </table>
        </div>
        <div class="container2">
            <h1>Enroll</h1>
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
                            echo "<td>".$row["student_code"]."</td>";
                            echo "<td>".$row["course_number"]."</td>";
                            echo "<td><input type='radio' name='selected_enroll' value='".$row["student_code"]."'></td>";
                            echo "<td>
                                <a class='btn-delete' href='delete.php?student_code=".$row["student_code"]."&course_number=".$row["course_number"]."&current_page=".$current_page."' onclick='return confirm(\"Are you sure you want to drop this enrollment?\");'>Drop</a>
                                </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>0 results</td></tr>";
                    }
                ?>
                </table>
                <p><a href="enroll_stud.php" class="btn-addStud">Enroll</a></p>
        </div>
        <div class="container2"></div>
    </div>
</body>
</html>