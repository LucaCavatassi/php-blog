<?php
// New object that create a connection to the db
$mysqli = new mysqli("localhost", "root", "root", "my_blog_db");

$sql = "SELECT posts.id, posts.title, posts.content, posts.created_at, posts.updated_at, categories.name, users.username
            FROM posts
            INNER JOIN categories ON posts.category_id = categories.id
            INNER JOIN users ON posts.user_id = users.id
            WHERE categories.name = ?
            ORDER BY posts.updated_at DESC";

$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $category); // "i" means integer
$stmt->execute();
$result = $stmt->get_result(); // Get the result set
$rows = $result->fetch_all(MYSQLI_ASSOC); // Fetch all posts

var_dump($rows);