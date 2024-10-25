<?php include 'layout.php'; ?>

<?php // New object that create a connection to the db
$mysqli = new mysqli("localhost", "root", "root", "my_blog_db");

// Query build
$sql = "SELECT *
        FROM categories";
// Result it's the query applied to the db
$result = $mysqli->query($sql);
// Fetch data (MYSQLI_ASSOC makes a key value array for each row)
$categories = $result->fetch_all(MYSQLI_ASSOC);

?>


<div class="container mt-5 d-flex justify-content-between align-items-center">
    <h1>All blog posts</h1>
    <div class="text-secondary d-flex gap-3 align-items-center">
        <span>Select a category</span>
        <form action="filter.php" method="GET">
            <select onchange="this.form.submit()" class="form-select" name="category" id="category">
                <option value="" disabled selected>Select a category...</option>
                <?php
                foreach ($categories as $category) {
                    echo '<option value="' . $category['id'] . '">' . htmlspecialchars($category['name']) . '</option>';
                }
                ?>
            </select>
        </form>
    </div>
</div>


<?php
// Include the fetch script to get posts
include 'home_page_guests.php';

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

        echo '<div class="card my-5">';

        if (isset($post['image'])) {
            echo '<img src="' . htmlspecialchars($post['image']) . '" class="card-img-top" alt="...">';
        } else {
            echo '<img src="https://media.istockphoto.com/id/1324356458/vector/picture-icon-photo-frame-symbol-landscape-sign-photograph-gallery-logo-web-interface-and.jpg?s=612x612&w=0&k=20&c=ZmXO4mSgNDPzDRX-F8OKCfmMqqHpqMV6jiNi00Ye7rE=" class="card-img-top" alt="...">';
        }
        echo   '<div class="card-body">
                            <div class="d-flex justify-content-between align-items-center"> 
                                <h5 class="card-title fw-bold fs-2">' . htmlspecialchars($post['title']) . '</h5>
                                <span class="fs-6 text-secondary"> <i>Last update </i><strong>' . date_format($date, 'm/d/Y') . '</strong></span>
                            </div>
                            <h6 class="card-subtitle mb-2 text-body-secondary">Written by <i><strong>' . htmlspecialchars($post['username']) . '</strong></i></h6>
                            <p class="card-subtitle mb-2 text-body-secondary">Category <i><strong>' . htmlspecialchars($post['name']) . '</strong></i></p>
                            <form action="show_post.php" method="POST">
                                <input type="hidden" name="id" value=' . $post['id'] . '>
                                <button type="submit" class="btn btn-primary">View Post</button>
                            </form>
                        </div>';

        echo    '</div>';
    }
    echo '</div>';
} else {
    echo '<div class="container mt-5">No posts found.</div>';
}
?>

<!-- 0650524923 opzione 6 -->