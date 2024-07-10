<?php
session_start();
require_once('db.php');

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Handle logout
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}

// Query to fetch user's full name based on username
$username = $_SESSION['username'];
$sql = "SELECT full_name FROM user_table WHERE user_name = '$username'";
$result = $conn->query($sql);

$sql2 = "SELECT * FROM student";
$result2 = $conn->query($sql2);

// Fetch the full name from the result
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $full_name = $row['full_name'];
} else {
    // Handle error if user not found or query fails
    $full_name = "Unknown";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .sidebar {
            background-color: #007bff;
            width: 200px;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            color: #fff;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
        }
        .sidebar h2 {
            text-align: left;
            color: #fff;
            margin-bottom: 20px;
        }
        .sidebar ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }
        .sidebar ul li {
            margin: 15px 0;
        }
        .sidebar ul li a {
            text-decoration: none;
            color: #fff;
            font-size: 18px;
            display: block;
            text-align: left;
        }
        .sidebar ul li a:hover {
            text-decoration: underline;
        }
        .logout-container {
            text-align: center;
            margin-top: auto;
        }
        .logout-container form {
            margin-bottom: 50px;
        }
        .logout-container input {
            background-color: #ff4d4d;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .logout-container input:hover {
            background-color: #ff3333;
        }
        .container {
            margin-left: 220px; /* Adjusted to account for sidebar width and spacing */
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
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

    <div class="container">
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
            if ($result2->num_rows > 0) {
                while($row = $result2->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>".$row["student_code"]."</td>";
                    echo "<td>".$row["first_name"]."</td>";
                    echo "<td>".$row["last_name"]."</td>";
                    echo "<td>".$row["programme"]."</td>";
                    echo "<td>
                            <a href='edit_student.php?id=".$row["id"]."'>Edit</a> | 
                            <a href='delete_student.php?id=".$row["id"]."' onclick='return confirm(\"Are you sure you want to delete this student?\");'>Delete</a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>0 results</td></tr>";
            }
            ?>
        </table>
        <p><a href="add_student.php">Add New Student</a></p>
    </div>
</body>
</html>
