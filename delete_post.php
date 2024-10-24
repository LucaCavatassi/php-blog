<?php
// New object that create a connection to the db
$mysqli = new mysqli("localhost", "root", "root", "my_blog_db");

session_start();

if (isset($_POST['id'])) {
    // Convert it into integer
    $id = (int)$_POST['id'];

    var_dump($id);
    
    $sql = "DELETE FROM posts WHERE `posts`.`id` = ?";
    
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $id); // "i" means integer
    $stmt->execute();
    
    // Execute the statement
    if ($stmt->execute()) {
        $_SESSION['success_message'] = "Your post it's been succesfully deleted!";
    } else {
        $_SESSION['error_message'] = "Error: " . $stmt->error;
    }

    header("Location: manage_post_page.php");
}
