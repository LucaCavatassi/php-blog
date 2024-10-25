<?php
include 'layout.php';

// New object that creates a connection to the db
$mysqli = new mysqli("localhost", "root", "root", "my_blog_db");

$sql = "SELECT posts.id, posts.title, posts.content, posts.image, posts.created_at, posts.updated_at, categories.name, users.username
        FROM posts
        INNER JOIN categories ON posts.category_id = categories.id
        INNER JOIN users ON posts.user_id = users.id
        WHERE posts.category_id = ?
        ORDER BY posts.updated_at DESC";

$category = isset($_GET['category']) ? (int)$_GET['category'] : null;

if ($category) {
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $category); // "i" means integer
    $stmt->execute();
    $result = $stmt->get_result(); // Get the result set
    $rows = $result->fetch_all(MYSQLI_ASSOC); // Fetch all posts
} else {
    $rows = [];
}
?>

<?php
if (!empty($rows)) {
    echo '<div class="container mt-3">';
    foreach ($rows as $post) {
        $date = isset($post['updated_at']) ? date_create($post['updated_at']) : date_create($post['created_at']);

        echo '<div class="card my-5">';
        echo isset($post['image'])
            ? '<img src="' . htmlspecialchars($post['image']) . '" class="card-img-top" alt="...">'
            : '<img src="https://media.istockphoto.com/id/1324356458/vector/picture-icon-photo-frame-symbol-landscape-sign-photograph-gallery-logo-web-interface-and.jpg?s=612x612&w=0&k=20&c=ZmXO4mSgNDPzDRX-F8OKCfmMqqHpqMV6jiNi00Ye7rE=" class="card-img-top" alt="...">';

        echo '<div class="card-body">
                    <div class="d-flex justify-content-between align-items-center"> 
                        <h5 class="card-title fw-bold fs-2">' . htmlspecialchars($post['title']) . '</h5>
                        <span class="fs-6 text-secondary"> <i>Last update </i><strong>' . date_format($date, 'm/d/Y') . '</strong></span>
                    </div>
                    <h6 class="card-subtitle mb-2 text-body-secondary">Written by <i><strong>' . htmlspecialchars($post['username']) . '</strong></i></h6>
                    <p class="card-subtitle mb-2 text-body-secondary">Category <i><strong>' . htmlspecialchars($post['name']) . '</strong></i></p>
                    <form action="show_post.php" method="POST">
                        <input type="hidden" name="id" value="' . $post['id'] . '">
                        <button type="submit" class="btn btn-primary">View Post</button>
                    </form>
                </div>';
        echo '</div>';
    }
    echo '</div>';
} else {
    echo '<div class="container mt-5">
            <h1>No posts found in this category.</h1>
        </div>';
}
?>