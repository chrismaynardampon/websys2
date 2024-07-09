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
    <title>Menu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            display: flex;
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
            margin: 0;
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
</body>
</html>
