<?php
session_start();
require('db.php');
include('operations.php');
$current_page = "enroll";

//enroll delete
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['stud_code']) && isset($_GET['course_num'])) {
    $stud_code = $_GET['stud_code'];
    $course_num = $_GET['course_num'];

    $sql = "DELETE FROM student_courses WHERE student_code = '$stud_code' and course_number = '$course_num'";

    if ($conn->query($sql) === TRUE) {
        header("Location: enroll.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enroll</title>
    <link rel="stylesheet" href="styles.css">
    <style>
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
        .forms-container{
            margin-top: 100px;
        }
    </style>
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
            <form action="enroll.php" method="post">
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
                            echo "<td>".htmlspecialchars($row["student_code"])."</td>";
                            echo "<td>".htmlspecialchars($row["first_name"])."</td>";
                            echo "<td>".htmlspecialchars($row["last_name"])."</td>";
                            echo "<td>".htmlspecialchars($row["programme"])."</td>";
                            echo "<td>
                               <input type='radio' name='selected_student' value='".htmlspecialchars($row["student_code"])."'>
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
                                echo "<td>".htmlspecialchars($row["course_number"])."</td>";
                                echo "<td>".htmlspecialchars($row["course_description"])."</td>";
                                echo "<td>".htmlspecialchars($row["units"])."</td>";
                                echo "<td>
                                    <input type='radio' name='selected_course' value='".htmlspecialchars($row["course_number"])."'>
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
            <h1>Enrollments</h1>
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
                            echo "<td>".htmlspecialchars($row["student_code"])."</td>";
                            echo "<td>".htmlspecialchars($row["course_number"])."</td>";
                            echo "<td>
                                <a class='btn-delete' href='enroll.php?stud_code=".htmlspecialchars($row["student_code"])."&course_num=".htmlspecialchars($row["course_number"])."&current_page=".htmlspecialchars($current_page)."' onclick='return confirm(\"Are you sure you want to drop this enrollment?\");'>Drop</a>
                                </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>0 results</td></tr>";
                    }
                ?>
            </table>
            <div class="form-group" style="width: 150px"><input type="submit" value="Enroll" class="btn-addStud"></div>
            </form>
        </div>
        <div class="container2"></div>
       
    </div>
    <!-- The Modal -->
    <div id="errorModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p id="errorMessage"></p>
        </div>
    </div>
    <script>
        var modal = document.getElementById("errorModal");
        var span = document.getElementsByClassName("close")[0];
        span.onclick = function() {
            modal.style.display = "none";
        }
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
        function showError(message) {
            document.getElementById("errorMessage").textContent = message;
            modal.style.display = "block";
        }
        <?php if (!empty($errors)) {
            foreach ($errors as $error) {
                echo "showError('".htmlspecialchars($error)."');";
            }
        } ?>
    </script>
</body>
</html>