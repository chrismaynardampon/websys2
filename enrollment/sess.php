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
$sql = "SELECT full_name FROM user_table WHERE user_name = '$username'";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $full_name = $row['full_name'];
} else {
    $full_name = "Unknown";
}
?>