<?php
session_start();

include'../mysql/connectMysql.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $userId = $_POST['user_id'];
    $newPassword = $_POST['new_password'];

    // Prepared statement to prevent SQL injection
    $stmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
    $stmt->bind_param("si", $newPassword, $userId); # s for string($newPassword) i for int($userId) 

    if ($stmt->execute()) {
        echo '<script>alert("Password updated successfully!");</script>';
        echo '<script>window.location.href = "accounts.php";</script>';
    } else {
        echo "Error updating password: " . $conn->error;
    }
    $stmt->close();
}

$conn->close();
?>
