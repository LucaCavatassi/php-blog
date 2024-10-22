<?php include 'layout.php'; ?>

<h1 class="container mt-5">All blogs posts</h1>

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
                echo '<h2>' . htmlspecialchars($post['title']) . '</h2>'; // Assuming there's a title field
                echo '<p>' . htmlspecialchars($post['content']) . '</p>'; // Assuming there's a content field
                echo '<hr>'; // Separator between posts
            }
        echo '</div>';
    } else {
        echo '<div class="container mt-5">No posts found.</div>';
    }
?>

<!-- 0650524923 opzione 6 -->