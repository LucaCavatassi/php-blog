<?php
    // New object that create a connection to the db
    $mysqli = new mysqli("localhost", "root", "root", "my_blog_db");

    // Query build
    $sql = "SELECT * FROM posts";
    // Result it's the query applied to the db
    $result = $mysqli->query($sql);
    // Fetch data (MYSQLI_ASSOC makes a key value array for each row)
    $rows = $result->fetch_all(MYSQLI_ASSOC);
