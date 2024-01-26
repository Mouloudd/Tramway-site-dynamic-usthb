<?php
// Establish connection to your MySQL database
include'connectMysql.php';

// Process signup form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "INSERT INTO users (username, password, is_admin) VALUES ('$username', '$password', 0)";

    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Signup successfully!");</script>';
        echo '<script>window.location.href = "../index.php";</script>';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
