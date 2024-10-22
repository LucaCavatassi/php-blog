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
    $username = htmlspecialchars(trim($_POST['username']));
    $password = $_POST['password'];

    // Prepare statement
    $stmt = $mysqli->prepare("SELECT * FROM users WHERE username = ?");
    // Attach param s means string
    $stmt->bind_param('s', $username);
    // Execute
    $stmt->execute();
    // Get the results
    $result = $stmt->get_result();
    
    // Fetch data
    // If number of rows retrieved it's more than 0 so the user it's found go on
    if ($result->num_rows > 0) {
        // Array key-value of data
        $user = $result->fetch_assoc();
        
        // Verify password
        if (password_verify($password, $user['password'])) {
            // If credentials are correct, store user details in session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['login_message'] = 'You successfully logged in!';
            
            // Redirect to home_page.php
            header('Location: home_page.php');
            exit();
        } else {
            // Invalid password
            $_SESSION['login_message'] = 'Your username or password is incorrect! Please try again.';
            header('Location: login_page.php');
            exit();
        }
    } else {
        // No such username found
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