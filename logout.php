<?php
    session_start();

    // Unset all of the session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();

    session_start();
    // Redirect to the login page with a message
    $_SESSION['login_message'] = "You have successfully logged out.";
    header("Location: login_page.php");
    exit();
