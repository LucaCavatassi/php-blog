<?php
// New object that creates a connection to the db
$mysqli = new mysqli("localhost","root","root","my_blog_db");

// Start session to store results message
session_start();

// Check connection, if there's an error, redirect
if ($mysqli->connect_errno) {
    $_SESSION['error_message'] = "Failed to connect to MySQL: " . $mysqli->connect_error;
    // Redirect to home_page.php
    header("Location: home_page.php");
    exit();
}

// Check if POST data is available
if (!empty($_POST['username']) && !empty($_POST['password'])) {
    // Query build
    $sql = "SELECT * FROM users";
    // Result - it's the query applied to the db
    $result = $mysqli->query($sql);
    
    // Fetch data (MYSQLI_ASSOC makes a key-value array for each row)
    $rows = $result->fetch_all(MYSQLI_ASSOC);
    
    // Login failed by default
    $login_successful = false;

    // Loop through the results to check username and hashed password
    foreach($rows as $row) {
        if ($row['username'] === $_POST['username'] && password_verify($_POST['password'], $row['password'])) {
            // If credentials are correct, store user details in session
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['login_message'] = 'You successfully logged in!'; // Fixed typo
            
            // Set flag for successful login
            $login_successful = true;
            
            // Redirect to home_page.php
            header('Location: home_page.php');
            exit();
        }
    }

    // If login failed after checking all rows
    if (!$login_successful) {
        $_SESSION['login_message'] = 'Your username or password is incorrect! Please try again.';
        header('Location: login_page.php');
        exit();
    }
} else {
    // If no POST data, redirect back to login page
    $_SESSION['login_message'] = 'Please provide both username and password.';
    header('Location: login_page.php');
    exit();
}
?>