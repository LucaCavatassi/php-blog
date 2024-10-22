<?php include 'layout.php'; ?>

<h1 class="container mt-5">All blog posts</h1>

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
                echo '<div class="card my-3">
                        <div class="card-body">
                            <h5 class="card-title">' . htmlspecialchars($post['title']) . '</h5>
                            <h6 class="card-subtitle mb-2 text-body-secondary">Written by <i><strong>' . htmlspecialchars($post['username']) . '</strong></i></h6>
                            <p class="card-text">' . htmlspecialchars($post['content']) . '</p>
                            <p class="card-subtitle mb-2 text-body-secondary">Category <i><strong>' . htmlspecialchars($post['name']) . '</strong></i></p>
                        </div>
                    </div>';
            }
        echo '</div>';
    } else {
        echo '<div class="container mt-5">No posts found.</div>';
    }
?>

<!-- 0650524923 opzione 6 -->