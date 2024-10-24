<?php
// index.php

// Get the current request URI
$request = $_SERVER['REQUEST_URI'];

// Check if the request is for the root ("/")
if ($request == '/' || $request == '/index.php') {
    // Serve home_page.php content when accessing "/"
    include 'home_page.php';
} else {
    // For any other routes, handle 404 or other files
    echo "404 - Page not found";
}
?>