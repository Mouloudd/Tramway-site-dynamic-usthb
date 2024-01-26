<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_subscription'])) {
    include'../mysql/connectMysql.php';

    $user_id = $_POST['user_id'];
    

    // Perform deletion query
    $sql = "DELETE FROM subscription WHERE id = $user_id";
    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Subscription was deleted successfully!");</script>';
        echo '<script>window.location.href = "sub.php";</script>';

    } else {
        echo "Error deleting subscription: " . $conn->error;
    }

    $conn->close();
} else {
    // Handle if the form data isn't submitted properly or if the request method isn't POST
    echo "Invalid request";
}
?>
