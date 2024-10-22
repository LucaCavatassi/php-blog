<?php
// Convert to integer
$id = (int)$_POST['id'];

// Redirect to show_post_page.php with post ID
header("Location: show_post_page.php?id=" . urlencode($id));
exit();
?>