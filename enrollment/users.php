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
    <title>Users</title>
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
        <h1>Users</h1>
        <table>
            <tr>
                <th>User Name</th>
                <th>Full Name</th>
                <th>Password</th>
                <th>Actions</th>
            </tr>
            <?php
            if ($result_user->num_rows > 0) {
                while($row = $result_user->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>".$row["user_name"]."</td>";
                    echo "<td>".$row["full_name"]."</td>";
                    echo "<td>".$row["password"]."</td>";
                    echo "<td>
                            <a class='btn-edit' href='edit_user.php?user_name=".$row["user_name"]."'>Edit</a> |
                            <a class='btn-delete' href='delete.php?user_name=".$row["user_name"]."' onclick='return confirm(\"Are you sure you want to delete this user?\");'>Delete</a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>0 results</td></tr>";
            }
            ?>
        </table>
        <p><a href="add_user.php" class="btn-addStud">Add New User</a></p>
    </div>
    </div>
</body>
</html>
