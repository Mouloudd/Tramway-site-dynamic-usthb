


<?php
session_start();

include'../mysql/connectMysql.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $newUsername = $_POST['new_username'];
    $newPassword = $_POST['new_password'];

    $sql = "INSERT INTO users (username, password) VALUES ('$newUsername', '$newPassword')";
    
    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("User added successfully!");</script>';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Query to get all users
$sql = "SELECT id, username , password FROM users";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Page</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    
    <style>
    .center {
        align-self:center ;
    }
    </style>
</head>
<body>
    <?php
    include 'index.php'
    ?>
    <h2>Welcome, <?php echo $_SESSION['username']; ?> (Admin)</h2>
    <h2 style= "color: #ccc" >List of Users:</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Password</th>
            <th>Action</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['username'] . "</td>";
                echo "<td>" . $row['password'] . "</td>";
                echo "<td>";
                // Form to modify password for each user
                echo "<form method='post' action='modify_password.php'>";
                echo "<input type='hidden' name='user_id' value='" . $row['id'] . "'>";
                echo "<label for='new_password_" . $row['id'] . "'>New Password:</label>";
                echo "<input type='password' id='new_password_" . $row['id'] . "' name='new_password' required>";
                echo "<input type='submit' name='submit' value='Update Password'>";
                echo "</form>";
                
                // Button to delete user for each row
                echo "<form method='post' action='delete_user.php'>";
                echo "<input type='hidden' name='user_id' value='" . $row['id'] . "'>";
                echo "<input type='submit' name='delete' value='Delete User'>";
                echo "</form>";
                
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No users found</td></tr>";
        }
        ?>
    </table>
    <!-- Any additional content or links for admin users -->
    <button class="add-user-button" onclick="toggleForm()">+ Add</button>

    <!-- Hidden form initially -->
    <div id="addUserForm" style="display: none;">
        <form method="post" action="">
            <label for="new_username">New Username:</label>
            <input type="text" id="new_username" name="new_username" required><br><br>
            
            <label for="new_password">New Password:</label>
            <input type="password" id="new_password" name="new_password" required><br><br>
            
            <input type="submit" name="submit" value="Add User">
        </form>
    </div>

    <!-- Existing content... -->

    <script>
        function toggleForm() {
            var form = document.getElementById("addUserForm");
            if (form.style.display === "none") {
                form.style.display = "block";
            } else {
                form.style.display = "none";
            }
        }
    </script>
</body>
</html>

<?php
$conn->close();
?>
