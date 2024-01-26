<?php
session_start();


// Connect to your database
include'../mysql/connectMysql.php';

// Query to get all users
$sql = "SELECT subscription.id, subscription.sub_type , subscription.date_sub , profile.nom, profile.prenom

FROM subscription
INNER JOIN profile ON subscription.id = profile.user_id

";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html>
<head>
    <title>subscription Page</title>
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
    <h2 style= "color: #ccc" >List of Subscription:</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Full name </th>
            <th>type of subscription</th>
            <th>date of end</th>
            <th>Action</th>

            
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['nom'].' '.$row['prenom']. "</td>";
                echo "<td>" . $row['sub_type'] . "</td>";
                echo "<td>" . $row['date_sub'] . "</td>";
                echo "<td>";
                echo "<form method='post' action='delete_subscription.php'>";
                echo "<input type='hidden' name='user_id' value='" . $row['id'] . "'>";
                echo "<button type='submit' name='delete_subscription'>Delete</button>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No users found</td></tr>";
        }
        ?>
    </table>
    </body>
</html>

<?php
$conn->close();
?>