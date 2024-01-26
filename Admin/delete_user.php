<?php
session_start();

include'../mysql/connectMysql.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $user_id = $_POST['user_id'];


    // Disable foreign key checks temporarily
    $conn->query('SET FOREIGN_KEY_CHECKS=0');

    // Delete records from dependent tables first
    $sqlDeleteProfile = "DELETE FROM profile WHERE user_id = $user_id";
    $sqlDeleteSubscription = "DELETE FROM subscription WHERE id = $user_id";

    // Perform deletion from dependent tables
    $conn->query($sqlDeleteSubscription);
    $conn->query($sqlDeleteProfile);

    $sql = "DELETE FROM users WHERE id = $user_id";

    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("User deleted successfully!");</script>';
        echo '<script>window.location.href = "accounts.php";</script>';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Enable foreign key checks again
    $conn->query('SET FOREIGN_KEY_CHECKS=1');
}

$conn->close();
?>
