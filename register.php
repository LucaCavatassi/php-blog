<?php
session_start();
// Connection to the database
$mysqli = new mysqli("localhost", "root", "root", "my_blog_db");

// Check connection
if ($mysqli->connect_errno) {
    $_SESSION['error_message'] = "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

// User input
$username = $_POST['username'];
$password = $_POST['password']; // Raw password from user input

// Hash the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Prepare the SQL statement
$stmt = $mysqli->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
$stmt->bind_param("ss", $username, $hashed_password);

// Execute the statement
if ($stmt->execute()) {
    $_SESSION['success_message'] = "You are succesfully registered. Login to start posting articles!";
} else {
    $_SESSION['error_message'] = "Error: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$mysqli->close();

header("Location: login_page.php");
?>