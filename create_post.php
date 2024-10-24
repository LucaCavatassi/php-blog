<?php 
// New object that creates a connection to the db
$mysqli = new mysqli("localhost","root","root","my_blog_db");

session_start();

// Check connection, if there's an error, redirect
if ($mysqli->connect_errno) {
    $_SESSION['error_message'] = "Failed to connect to MySQL: " . $mysqli->connect_error;
    // Redirect to home_page.php
    header("Location: home_page.php");
    exit();
}

var_dump($_POST);

// Check post data if present
if (empty($_POST['title']) || empty($_POST['content']) || empty($_POST['user_id']) || empty($_POST['category_id'])) {
    $_SESSION['form_data'] = $_POST;
    $_SESSION['error_message'] = "Some field was missing, please try again.";
    // Redirect to create_post_page.php
    header("Location: create_post_page.php");
    exit();
};