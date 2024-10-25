<?php
        // New object that create a connection to the db
        $mysqli = new mysqli("localhost", "root", "root", "my_blog_db");

        // Query build
        $sql = "SELECT posts.id, posts.title, posts.content, posts.image, posts.created_at, posts.updated_at, categories.name, users.username
                FROM posts
                INNER JOIN categories ON posts.category_id = categories.id
                INNER JOIN users ON posts.user_id = users.id;";
        // Result it's the query applied to the db
        $result = $mysqli->query($sql);
        // Fetch data (MYSQLI_ASSOC makes a key value array for each row)
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        