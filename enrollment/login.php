<?php
session_start();
require_once('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (isset($_POST['login'])) {
        $sql = "SELECT * FROM user_table WHERE user_name = '$username' AND password = '$password'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $_SESSION['username'] = $username;
            header("Location: menu.php");
            exit();
        } else {
            // Login failed
            $error_message = "Invalid username or password";
        }
    } elseif (isset($_POST['register'])) {
        $sql = "insert into user_table values('$username','hatdog','$password')";
        $result = $conn->query($sql);
	$sql = "SELECT * FROM user_table WHERE user_name = '$username' AND password = '$password'";
        $result = $conn->query($sql);
        if ($result->num_rows == 1) {
            $_SESSION['username'] = $username;
            header("Location: menu.php");
            exit();
        } else {
            // Login failed
            $error_message = "Invalid username or password";
        }
        echo "Register button clicked";
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
        
        <!-- Two submit buttons with different values -->
        <input type="submit" name="register" value="Register">
        <input type="submit" name="login" value="Login">
    </form>

    <?php
    if (isset($error_message)) {
        echo "<p>$error_message</p>";
    }
    ?>
</body>
</html>
