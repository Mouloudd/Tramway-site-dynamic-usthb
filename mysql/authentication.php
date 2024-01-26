<?php
session_start();

include'connectMysql.php';

// Process login form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT id, username, password, is_admin FROM users WHERE username='$username' ";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($password ==$row['password']) {
            $_SESSION['username'] = $username; // Store username in session
            
            if ($row['is_admin'] == 1) {
                header("Location: ../Admin/index.php"); // Redirect to admin page
                exit();
            } else {
                header("Location: ../user/user_page.php"); // Redirect to user page
                exit();
            }
        } else {
            echo '<script>alert("incorrect username or password!");</script>';
            echo '<script>window.location.href = "../index.php";</script>';
        }
    } else {
        echo '<script>alert("User not exist");</script>';
        echo '<script>window.location.href = "../index.php";</script>';
    }
}

$conn->close();
?>
