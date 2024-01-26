<?php
$servername = "mysql-dekar.alwaysdata.net";
$username = "dekar";
$password = "Dekarm2002!";


// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sqlCreateDB = "CREATE DATABASE IF NOT EXISTS dekar_setram";
if ($conn->query($sqlCreateDB) === TRUE) {
    echo "Database created successfully<br>";
} else {
    echo "Error creating database: " . $conn->error . "<br>";
}

// Select created database
$conn->select_db("dekar_setram");

// SQL query to create users table
$sqlCreateTable = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    is_admin TINYINT NOT NULL DEFAULT 0
)";

// Execute table creation query
if ($conn->query($sqlCreateTable) === TRUE) {
    echo "Table 'users' created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$sqlProfile = "CREATE TABLE IF NOT EXISTS profile(
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    nom VARCHAR(32) NOT NULL,
    prenom VARCHAR(32) NOT NULL,
    email VARCHAR(32) NOT NULL,
    image TEXT NOT NULL,
    date_naissance DATE NOT NULL,
    numero INT(12) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id)
)";

if ($conn->query($sqlProfile) === TRUE) {
    echo "<br>Table 'profile' created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$sqlsub = "CREATE TABLE IF NOT EXISTS subscription(
    num INT AUTO_INCREMENT PRIMARY KEY,
    id INT,
    sub_type varchar(30),
    date_now date DEFAULT CURRENT_TIMESTAMP,
    date_sub date NOT NULL,
    is_active int NOT NULL DEFAULT 0,
    FOREIGN KEY (id) REFERENCES profile(user_id)
)
";
if ($conn->query($sqlsub) === TRUE) {
    echo "<br>Table 'subscription' created successfully";
} else {
    echo "<br>Error creating table: " . $conn->error;
}

$conn->close();
?>
