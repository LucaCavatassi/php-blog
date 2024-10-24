<?php
// New object that creates a connection to the db
$mysqli = new mysqli("localhost", "root", "root", "my_blog_db");

// Start session to store results message
session_start();

// Check connection, if there's an error, redirect
if ($mysqli->connect_errno) {
    $_SESSION['error_message'] = "Failed to connect to MySQL: " . $mysqli->connect_error;
    header("Location: manage_post_page.php");
    exit();
}

// Check if POST data is available
if (isset($_POST['id']) && !empty($_POST['title']) && !empty($_POST['content'])) {
    $post_id = (int)$_POST['id'];
    $title = htmlspecialchars(trim($_POST['title']));
    $content = htmlspecialchars(trim($_POST['content']));
    $user_id = (int)$_POST['user_id'];
    $category_id = (int)$_POST['category_id'];

    // Prepare statement to update the post
    $stmt = $mysqli->prepare("UPDATE posts SET title = ?, content = ?, user_id = ?, category_id = ?, updated_at = NOW() WHERE id = ?");
    $stmt->bind_param("ssiii", $title, $content, $user_id, $category_id, $post_id);
    $stmt->execute();

    // Clear the session data after successful update
    $_SESSION['success_message'] = "Your post has been updated successfully.";
    
    // Redirect to a success page or the updated post page
    header("Location: manage_post_page.php");
    exit();
} else {
    // Redirect if the required fields are not provided
    $_SESSION['error_message'] = "All fields are required.";
    header("Location: edit_post_page.php?id=" . $_POST['id']);
    exit();
}
?>