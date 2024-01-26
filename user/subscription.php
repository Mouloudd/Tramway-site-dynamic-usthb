<?php

session_start();

include'../mysql/connectMysql.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $duration = $_POST['duration'];
    $subscription_type = $_POST['subscription_type'];

    // Get current date
    $date_now = date('Y-m-d');

    // Calculate subscription end date based on selected duration
    $date_sub = date('Y-m-d', strtotime("+$duration months"));

    // Assuming you have a user_id, replace '1' with the actual user ID
    $username = $_SESSION['username'];

    // Get the user's ID from the users table
    $sqlUserID = "SELECT id FROM users WHERE username = '$username'";
    $userResult = $conn->query($sqlUserID);

    if ($userResult->num_rows > 0) {
        $userRow = $userResult->fetch_assoc();
        $user_id = $userRow['id'];

        $sqlProfileCheck = "SELECT * FROM subscription WHERE id = $user_id";
        $profileResult = $conn->query($sqlProfileCheck);

        if ($profileResult->num_rows === 0) {
        // Insert subscription data into the database
            $sql = "INSERT INTO subscription (id, sub_type, date_now, date_sub, is_active) VALUES ('$user_id', '$subscription_type', '$date_now', '$date_sub', 1)";

            if ($conn->query($sql) === TRUE) {
                echo '<script>alert("subscription insert successfully!");</script>';
            } else {
                echo '<script>alert("there is already subscription");</script>'. $conn->error;
            }}
            else {
                echo '<script>alert("there is already subscription running");</script>'. $conn->error;
            }
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Subscription Form</title>
    <style>
        form {
    height: 300px;
    font-family: "Poppins" , sans-serif;
    display: flex;
    flex-direction: column;
    background-color: rgba(168,201,255,0.5);
    /* Make the background cover the entire viewport */
    background-size: cover;
    /* Ensure the background remains fixed as the content scrolls */
    background-attachment: fixed;
    border: none;
    border-radius: 10px;
    justify-content: center;
    color: #1f4c65;
    
    align-items: center;
    width: 85%; /* Adjust the width as needed */
    /* You can also add max-width or min-width for responsiveness */
    max-width: 750px; 
    width: 80%; /* Adjust the width as needed */
    margin: 100px auto
   
}

.form-group {
    margin-bottom: 15px;
    
}

label {
    font-weight: bold;
    color: #cecbcb;
    
}
select {
  padding: 8px 12px; /* Adjust padding as needed */
  border: none; /* Border style */
  border-radius: 5px; /* Rounded corners */
  font-size: 16px; /* Font size */
  background-color: #4674A9; /* Background color */
  color: #ccc; /* Text color */
  appearance: none; /* Remove default styles (arrow icon) in some browsers */
  -webkit-appearance: none; /* For older versions of webkit browsers */
  -moz-appearance: none; /* For older versions of Firefox */
}

/* Style for option elements */
option {
  /* Customize option appearance */
  padding: 8px 12px; /* Adjust padding as needed */
  background-color: #fff; /* Background color */
  color: #333; /* Text color */
}

/* Hover style for options */
option:hover {
  background-color: #f0f0f0; /* Change background color on hover */
}
input[type="submit"] {
  padding: 10px 10px; /* Adjust padding as needed */
  border: none; /* Remove the default border */
  border-radius: 5px; /* Rounded corners */
  background-color: #2EA379; /* Background color */
  color: white; /* Text color */
  font-size: 16px; /* Font size */
  cursor: pointer; /* Cursor style */
  transition: background-color 0.3s ease; /* Smooth transition for hover effect */
}
input[type="submit"]:hover {
  background-color: #45a049; /* Change background color on hover */
}

    </style>
</head>
<body>
<?php
    include 'user_page.php'
    ?>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="duration">Select Subscription Duration:</label>
        <select name="duration" id="duration">
            <option value="1">1 Month</option>
            <option value="3">3 Months</option>
        </select><br><br>

        <label for="subscription_type">Select Subscription Type:</label>
        <select name="subscription_type" id="subscription_type">
            <option value="normal">Normal</option>
            <option value="vip">VIP</option>
            <option value="premium">Premium</option>
        </select><br><br>

        <input type="submit" value="Submit">
    </form>
</body>
</html>
