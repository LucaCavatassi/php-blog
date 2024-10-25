<?php include 'layout.php'; ?>

<h1 class="container mt-5">Your posts</h1>

<?php
// New object that create a connection to the db
$mysqli = new mysqli("localhost", "root", "root", "my_blog_db");

$user_id = (int)$_SESSION['user_id']; // Ensure user_id is an integer

$sql = "SELECT posts.id, posts.title, posts.content, posts.created_at, posts.updated_at, categories.name, users.username
            FROM posts
            INNER JOIN categories ON posts.category_id = categories.id
            INNER JOIN users ON posts.user_id = users.id
            WHERE posts.user_id = ?
            ORDER BY posts.updated_at DESC";

$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $user_id); // "i" means integer
$stmt->execute();
$result = $stmt->get_result(); // Get the result set
$rows = $result->fetch_all(MYSQLI_ASSOC); // Fetch all posts

// Print messages (if any)
if (isset($_SESSION['error_message'])) {
    echo '<div class="container mt-5 alert alert-danger" role="alert">' . $_SESSION['error_message'] . '</div>';
    unset($_SESSION['error_message']);
}

// Check if rows have been fetched and display them
if (!empty($rows)) {
    echo '<div class="container mt-3">';
    foreach ($rows as $post) {
        // Check if updated date exist print that if not print the created date
        if (isset($post['updated_at'])) {
            $date = date_create($post['updated_at']);
        } else {
            $date = date_create($post['created_at']);
        }

        echo '<div class="card my-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center"> 
                                <h5 class="card-title fw-bold fs-2">' . htmlspecialchars($post['title']) . '</h5>
                                <span class="fs-6 text-secondary"> <i>Last update </i><strong>' . date_format($date, 'm/d/Y') . '</strong></span>
                            </div>
                            <h6 class="card-subtitle mb-2 text-body-secondary">Written by <i><strong>' . htmlspecialchars($post['username']) . '</strong></i></h6>
                            <p class="card-subtitle mb-2 text-body-secondary">Category <i><strong>' . htmlspecialchars($post['name']) . '</strong></i></p>
                            <div class="d-flex gap-2">
                                <form action="show_post.php" method="POST">
                                    <input type="hidden" name="id" value=' . $post['id'] . '>
                                    <button type="submit" class="btn btn-primary">View Post</button>
                                </form>
                                <form action="edit_post_page.php" method="POST">
                                    <input type="hidden" name="id" value=' . $post['id'] . '>
                                    <button type="submit" class="btn btn-info">Edit Post</button>
                                </form>
                                <form action="delete_post.php" method="POST">
                                    <input type="hidden" name="id" value=' . $post['id'] . '>
                                    <button type="submit" class="btn btn-danger">Delete Post</button>
                                </form>
                            </div>
                        </div>
                    </div>';
    }
    echo '</div>';
} else {
    echo '<div class="container mt-5">No posts found.</div>';
}
?>

<!-- 0650524923 opzione 6 -->