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

// Initialize variables for form validation
$student_code = $first_name = $last_name = $programme = '';
$errors = [];

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize inputs
    $student_code = htmlspecialchars($_POST['student_code']);
    $first_name = htmlspecialchars($_POST['first_name']);
    $last_name = htmlspecialchars($_POST['last_name']);
    $programme = htmlspecialchars($_POST['programme']);

    // Basic validation - check if required fields are empty
    if (empty($student_code)) {
        $errors[] = "Student Code is required";
    }
    if (empty($first_name)) {
        $errors[] = "First Name is required";
    }
    if (empty($last_name)) {
        $errors[] = "Last Name is required";
    }
    if (empty($programme)) {
        $errors[] = "Programme is required";
    }

    // If no errors, insert data into database
    if (empty($errors)) {
        // Prepare and execute SQL statement to insert new student
        $sql_insert = "INSERT INTO student (student_code, first_name, last_name, programme) 
                       VALUES ('$student_code', '$first_name', '$last_name', '$programme')";

        if ($conn->query($sql_insert) === TRUE) {
            // Redirect to students.php after successful insertion
            header("Location: students.php");
            exit();
        } else {
            // Handle database error
            $errors[] = "Error: " . $sql_insert . "<br>" . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
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
        .container {
            width: 400px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .form-group input {
            width: calc(100% - 10px);
            padding: 8px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .form-group input[type="submit"] {
            background-color: #007bff;
            color: white;
            cursor: pointer;
        }
        .form-group input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .error-message {
            color: #ff4d4d;
            font-size: 14px;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Add New Student</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="student_code">Student Code:</label>
                <input type="text" id="student_code" name="student_code" value="<?php echo $student_code; ?>" required>
            </div>
            <div class="form-group">
                <label for="first_name">First Name:</label>
                <input type="text" id="first_name" name="first_name" value="<?php echo $first_name; ?>" required>
            </div>
            <div class="form-group">
                <label for="last_name">Last Name:</label>
                <input type="text" id="last_name" name="last_name" value="<?php echo $last_name; ?>" required>
            </div>
            <div class="form-group">
                <label for="programme">Programme:</label>
                <input type="text" id="programme" name="programme" value="<?php echo $programme; ?>" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Add Student">
            </div>
        </form>
        <?php
        // Display validation errors if any
        if (!empty($errors)) {
            echo '<div class="error-message"><ul>';
            foreach ($errors as $error) {
                echo '<li>' . $error . '</li>';
            }
            echo '</ul></div>';
        }
        ?>
    </div>
</body>
</html>
