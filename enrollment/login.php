<?php
session_start();
require_once('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate input to prevent SQL injection (not shown here for brevity)

    $sql = "SELECT * FROM User WHERE user_name = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Login successful
        $_SESSION['username'] = $username;
        header("Location: menu.php");
        exit();
    } else {
        // Login failed
        $error_message = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label>Username:</label><br>
        <input type="text" name="username" required><br><br>
        
        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>
        
        <input type="submit" value="Register">
	<input type="submit" value="Login">
    </form>

    <?php
    if (isset($error_message)) {
        echo "<p>$error_message</p>";
    }
    ?>
</body>
</html>
