<?php
session_start();
require_once('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $fullname = $_POST['fullname'] ?? '';

    if (isset($_POST['register'])) {
        $sql = "insert into user_table values('$username','$fullname','$password')";
        $result = $conn->query($sql);
	$sql = "SELECT * FROM user_table WHERE user_name = '$username' AND password = '$password'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $_SESSION['username'] = $username;
            header("Location: menu.php");
            exit();
        } else {
            $error_message = "Invalid username or password";
        }
    } elseif (isset($_POST['login'])) {
        header("Location: login.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        h2 {
            margin-top: 0;
            color: #333;
	    display: flex;
            justify-content: center;
            align-items: center;

        }
        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
        }
        input[type="text"],
        input[type="password"] {
            width: 93%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            color: #fff;
            background-color: #007bff;
            margin-bottom: 10px;
        }
        input[type="submit"]:hover {
            opacity: 0.9;
        }
        .error-message {
            color: red;
            margin-top: 10px;
        }
        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }
        .modal-content {
            background-color: #fff;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 400px;
            border-radius: 8px;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Register</h2>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username">

	    <label for="fullname">Fullname:</label>
            <input type="text" id="fullname" name="fullname">

            <label for="password">Password:</label>
            <input type="password" id="password" name="password">
            
            <input type="submit" name="register" value="Register">
            <input type="submit" name="login" value="Login">
        </form>
    </div>

    <!-- The Modal -->
    <div id="errorModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p id="errorMessage"></p>
        </div>
    </div>

    <?php if (isset($error_message)): ?>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            var modal = document.getElementById("errorModal");
            var span = document.getElementsByClassName("close")[0];
            var errorMessage = "<?php echo $error_message; ?>";

            document.getElementById("errorMessage").textContent = errorMessage;
            modal.style.display = "block";

            span.onclick = function() {
                modal.style.display = "none";
            }

            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        });
    </script>
    <?php endif; ?>
</body>
</html>
