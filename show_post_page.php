<?php include('layout.php')?>

<?php
// Connect to db
$mysqli = new mysqli("localhost", "root", "root", "my_blog_db");

// Check if id exist
if (isset($_GET['id'])) {
    // Convert it into integer
    $id = (int)$_GET['id'];

    // Prepare statement
    $stmt = $mysqli->prepare("SELECT posts.id, posts.title, posts.content, categories.name, users.username
            FROM posts
            INNER JOIN categories ON posts.category_id = categories.id
            INNER JOIN users ON posts.user_id = users.id
            WHERE posts.id = ?");

    // Bind and execute
    $stmt->bind_param("i", $id);
    $stmt->execute();
    // Get result
    $result = $stmt->get_result();

    // If results are major then 0 so have been found save data into an associative array
    if ($result->num_rows > 0) {
        $post = $result->fetch_assoc();

        // Display the post data
        echo "<div class='container mt-3'>";
        echo "<h1>" . htmlspecialchars($post['title']) . "</h1>";
        echo "<p>" . nl2br(htmlspecialchars($post['content'])) . "</p>";
        echo "<p>Category: " . htmlspecialchars($post['name']) . "</p>";
        echo "<p>Posted by: " . htmlspecialchars($post['username']) . "</p>";
        echo "</div";
    } else {
        echo "<div class='container mt-3'>";
        echo "<h1> Post not found. </h1>";
        echo "</div";

    }

    // Close the statement
    $stmt->close();
} else {
    echo "No post ID provided.";
}

// Close the database connection
$mysqli->close();
?>
