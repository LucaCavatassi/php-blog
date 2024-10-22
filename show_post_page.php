<?php include('layout.php')?>

<?php
// Connect to db
$mysqli = new mysqli("localhost", "root", "root", "my_blog_db");

// Check if id exist
if (isset($_GET['id'])) {
    // Convert it into integer
    $id = (int)$_GET['id'];

    // Prepare statement
    $stmt = $mysqli->prepare("SELECT posts.id, posts.title, posts.content, posts.created_at, posts.updated_at, categories.name, users.username
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

        $dateCreate = date_create($post['created_at']);
        $dateUpdate = date_create($post['updated_at']);

        // Display the post data
        echo "<div class='container mt-3'>";
            echo "<div class='d-flex justify-content-between align-items-center my-4'>";
                echo "<h1 class='mb-0'>" . htmlspecialchars($post['title']) . "</h1>";
                echo "<a href='home_page.php' class='btn btn-secondary'>&leftarrow; Show posts</a>";
            echo "</div>";

            echo "<p>" . nl2br(htmlspecialchars($post['content'])) . "</p>";

            echo "<div class='d-flex justify-content-between align-items-center mt-4'>";
                echo "<p class='text-secondary'>Written by <i><strong> " . htmlspecialchars($post['username']) . " </i></strong></p>";
                echo "<p class='text-secondary'>Category <i><strong> " . htmlspecialchars($post['name']) . " </i></strong></p>";
            echo "</div>";

            echo "<div>";
                echo "<p class='text-secondary'>Created on <i><strong> " . date_format($dateCreate, 'm/d/Y') . " </i></strong></p>";
                echo "<p class='text-secondary'>Last update on <i><strong> " . date_format($dateUpdate, 'm/d/Y') . " </i></strong></p>";
            echo "</div>";

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
