<?php
include 'layout.php';
// New object that creates a connection to the db
$mysqli = new mysqli("localhost", "root", "root", "my_blog_db");


// Check connection, if there's an error, redirect
if ($mysqli->connect_errno) {
    $_SESSION['error_message'] = "Failed to connect to MySQL: " . $mysqli->connect_error;
    header("Location: home_page.php");
    exit();
}

// Check if POST data is available
if (isset($_POST['id'])) {
    $post_id = (int)$_POST['id'];

    // Prepare statement to fetch post data
    $stmt = $mysqli->prepare("SELECT * FROM posts WHERE id = ?");
    $stmt->bind_param('i', $post_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch the post data
    if ($result->num_rows > 0) {
        $post = $result->fetch_assoc();
    } else {
        // Redirect if the post is not found
        $_SESSION['error_message'] = "Post not found.";
        header("Location: home_page.php");
        exit();
    }
} else {
    // Redirect if no ID is provided
    $_SESSION['error_message'] = "No post ID provided.";
    header("Location: home_page.php");
    exit();
}
?>

<!-- Edit Post Form -->
<div class="container mt-4">
    <h1>Edit Post</h1>
    <form class="ms-form" action="edit_post.php" method="POST">
        <!-- Hidden ID field -->
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($post['id']); ?>">
        
        <!-- Title -->
        <div class="mb-3">
            <label for="title" class="form-label fw-bold">Title*</label>
            <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($post['title']); ?>" required>
        </div>

        <!-- Content -->
        <div class="mb-3">
            <label for="content" class="form-label fw-bold">Content*</label>
            <textarea id="content" name="content" class="form-control" required><?php echo htmlspecialchars($post['content']); ?></textarea>
        </div>

        <!-- Category -->
        <div class="mb-3">
            <label for="category_id" class="form-label fw-bold">Category*</label>
            <select id="category_id" name="category_id" class="form-select" required>
                <option value="" disabled>Select category</option>
                <?php
                // Fetch categories from the database
                $sqlCategories = "SELECT * FROM categories";
                $resultCat = $mysqli->query($sqlCategories);
                $rowsCat = $resultCat->fetch_all(MYSQLI_ASSOC);
                
                foreach ($rowsCat as $category) {
                    $selected = ($category['id'] == $post['category_id']) ? 'selected' : '';
                    echo '<option value="' . $category['id'] . '" ' . $selected . '>' . htmlspecialchars($category['name']) . '</option>';
                }
                ?>
            </select>
        </div>

        <!-- Author/User -->
        <div class="mb-3">
            <label for="user_id" class="form-label fw-bold">Author - </label>
            <input type="hidden" id="user_id" name="user_id" value="<?php echo htmlspecialchars($_SESSION['user_id']); ?>">
            <span class="fs-6"><?php echo htmlspecialchars($_SESSION['username']); ?></span>
        </div>
        <!-- Author/User -->

        <!-- IMG -->
        <div class="mb-3">
            <label for="image" class="form-label fw-bold">Image URL - </label>
            <div class="input-group">
                <span class="input-group-text" id="basic-addon">https://example.com/users/</span>
                <input type="url" name="image" class="form-control" id="image" aria-describedby="image-url" value="<?php echo isset($post['image']) ? $post['image'] : ''; ?>">
            </div>
            <div class="form-text" id="basic-addon4">Insert the url here</div>
        </div>
        <!-- IMG -->
        
        <!-- Submit -->
        <button type="submit" class="btn btn-primary">Update Post</button>
    </form>
</div>