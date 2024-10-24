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
} else {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $user_id = (int)$_POST['user_id'];
    $category_id = (int)$_POST['category_id'];

    // Prepare the SQL statement; remove `id` if it's auto-increment
    $stmt = $mysqli->prepare("INSERT INTO posts (`title`, `content`, `user_id`, `category_id`, `created_at`, `updated_at`) VALUES (?, ?, ?, ?, NOW(), NOW())");
    $stmt->bind_param("ssii", $title, $content, $user_id, $category_id);
    $stmt->execute();

    // Clear the session data after successful insertion
    unset($_SESSION['form_data']);
    
    $_SESSION['success_message'] = "Your post has been added to the blog.";
    // Redirect to a success page or the created post page
    header("Location: home_page.php");
    exit();
};