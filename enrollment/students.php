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
    <title>Students</title>
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
                            <a class='btn-delete' href='delete.php?student_code=".$row["student_code"]."' onclick='return confirm(\"Are you sure you want to delete this student?\");'>Delete</a>
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
    </div>
</body>
</html>