<?php
    // New object that create a connection to the db
    $mysqli = new mysqli("localhost", "root", "root", "my_blog_db");

    // Query build
    $stmt = $mysqli->prepare("SELECT posts.id, posts.title, posts.content, categories.name, users.username
            FROM posts
            INNER JOIN categories ON posts.category_id = categories.id
            INNER JOIN users ON posts.user_id = users.id
            WHERE posts.id = ?");

    // Convert to integer
    $id = (int)$_POST['id'];

    // Bind the parameter
    $stmt->bind_param("i", $id);

    // Execute the statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Fetch the post data
    $post = $result->fetch_assoc();

    // Close the statement
    $stmt->close();

    header("Location: 'show_post_page.php'");