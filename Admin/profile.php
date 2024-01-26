<?php
session_start();
$uploadDirectory = "uploads/";


include'../mysql/connectMysql.php';

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form inputs
    $id = $_POST['id'];
    $nom = $conn->real_escape_string($_POST['nom']);
    $prenom = $conn->real_escape_string($_POST['prenom']);
    $email = $conn->real_escape_string($_POST['email']);
    
    $date_naissance = $_POST['date_naissance'];
    $numero = $_POST['numero'];

    $targetDirectory = "uploads/"; // Specify your target directory
    $targetFile = $targetDirectory . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    // Check file size
    if ($_FILES["image"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";
            // Here, you can save $targetFile (the file path) to your database as needed.
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    $image = $targetFile;
    // Update the profile information in the database for the given ID
    $sql = "UPDATE profile SET nom='$nom', prenom='$prenom', email='$email', image='$image', date_naissance='$date_naissance', numero='$numero' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Profile uodate successfully!");</script>';
    } else {
        echo "Error updating profile: " . $conn->error;
    }
    
}

// Fetch profile information using the username from the session
$username = $_SESSION['username'];

// Get the user's ID from the users table
$sqlUserID = "SELECT id FROM users WHERE username = '$username'";
$userResult = $conn->query($sqlUserID);

if ($userResult->num_rows > 0) {
    $userRow = $userResult->fetch_assoc();
    $user_id = $userRow['id'];

    // Check if the profile for the user exists
    $sqlProfileCheck = "SELECT * FROM profile WHERE user_id = $user_id";
    $profileResult = $conn->query($sqlProfileCheck);

    if ($profileResult->num_rows === 0) {
        // If the profile doesn't exist, insert the profile information
        $sqlInsertProfile = "INSERT INTO profile (user_id, nom, prenom, email, image, date_naissance, numero) VALUES ('$user_id', '', '', '', '', '', '')";
        if ($conn->query($sqlInsertProfile) === TRUE) {
            echo '<script>alert("Profile insert successfully!");</script>';
        } else {
            echo "Error inserting profile: " . $conn->error . "<br>";
        }
    }

    // Select profile information based on the user's ID
    $sqlSelect = "SELECT * FROM profile WHERE user_id = $user_id";
    $profileResult = $conn->query($sqlSelect);

    if ($profileResult->num_rows > 0) {
        $profileRow = $profileResult->fetch_assoc();
        // Assign profile details to variables
        $id = $profileRow['id'];
        $nom = $profileRow['nom'];
        $prenom = $profileRow['prenom'];
        $email = $profileRow['email'];
        $image = $profileRow['image'];
        $date_naissance = $profileRow['date_naissance'];
        $numero = $profileRow['numero'];
    } else {
        echo "Profile not found";
    }
} else {
    echo "User not found";
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Modify Profile</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: turquoise;
}

.container {
    width: 80%;
    margin: 0 auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

h2 {
    text-align: center;
}

form {
    display: flex;
    flex-direction: column;
    background-color: rgba(0, 0, 0, 0.5);
    border: none;
    border-radius: 10px;
    justify-content: center;
    color: #ccc;
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
}

input[type="text"],
input[type="file"],input[type="email"],input[type="date"] {
    margin-top: 1rem;
  border-radius: 10px;
  outline: 2px solid #00a6fb;
  
  color: black;
  border: 0;
  font-family: "Montserrat", sans-serif;
  background-color: #d6f1ff;
  outline-offset: 3px;
  padding: 10px 12.5px;
  transition: all 0.2s ease;
  width: 250px;
}
input[type="text"]:hover,
input[type="file"]:hover,input[type="email"] {
    background-color: #fff;
}
input[type="text"]:focus,
input[type="file"]:focus,input[type="email"] {
    outline-offset: -6px;
  background-color: #d6f1ff;
}




input[type="submit"]{
    width: 30%;
    align-self: center;

  font-size: 1.2rem;
  padding: 1rem 2.5rem;
  border: none;
  outline: none;
  border-radius: 0.4rem;
  cursor: pointer;
  text-transform: uppercase;
  background-color: rgb(14, 14, 26);
  color: rgb(234, 234, 234);
  font-weight: 700;
  transition: 0.6s;
  box-shadow: 0px 0px 60px #1f4c65;
  -webkit-box-reflect: below 10px linear-gradient(to bottom, rgba(0,0,0,0.0), rgba(0,0,0,0.4));
}

input[type="submit"]:active {
  scale: 0.92;
}

input[type="submit"]:hover {
  background: rgb(2,29,78);
  background: linear-gradient(270deg, rgba(2, 29, 78, 0.681) 0%, rgba(31, 215, 232, 0.873) 60%);
  color: rgb(4, 4, 38);
}

button[type="submit"] {
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    background-color: #3498db;
    color: #fff;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button[type="submit"]:hover {
    background-color:#3498db;
}

.profile-image {
    margin-top: 30px;
    text-align: center;
}

.profile-image img {
    width: 200px;
    height: 200px;
    border-radius: 50%;
    border: 2px solid #3498db;
    object-fit: cover;
}

    </style>
</head>
<body>
    <?php
    include 'index.php'
    ?>
<div class="profile-image">
            <h2 style="color:#ccc">Profile Image</h2>
    <area><!-- Display profile image -->
<!-- Display profile image -->
<img src="<?php echo isset($image) && file_exists($image) ? $image : 'works.png'; ?>" alt="Profile Image" width="200" height="200">

</area>
</div>
<!-- Form to modify profile -->
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo isset($id) ? $id : ''; ?>"> <!-- Hidden field to carry ID -->
    Nom: <input type="text" name="nom" value="<?php echo isset($nom) ? $nom : ''; ?>"><br>
    Prenom: <input type="text" name="prenom" value="<?php echo isset($prenom) ? $prenom : ''; ?>"><br>
    Email: <input type="email" name="email" value="<?php echo isset($email) ? $email : ''; ?>"><br>
    Image: <input type="file" name="image"><br> <!-- Input type file for image upload -->
    Date de Naissance: <input type="date" name="date_naissance" value="<?php echo isset($date_naissance) ? $date_naissance : ''; ?>"><br>
    Numero: <input type="text" name="numero" value="<?php echo isset($numero) ? $numero : ''; ?>"><br>
    <input type="submit" name="submit" value="Modify Profile">
</form>

</body>
</html>
