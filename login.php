<?php
    // New object that create a connection to the db
    $mysqli = new mysqli("localhost","root","root","my_blog_db");

    // Start session to store results message
    session_start();

    // Check connection if error redirect
    if ($mysqli -> connect_errno) {
        $_SESSION['error_message'] = "Failed to connect to MySQL: " . $mysqli -> connect_error;
        // Redirect to index.php
        header("Location: index.php");
        // Exit connection
        exit();
    }

    // Query build
    $sql = "SELECT * FROM users";
    // Result it's the query applied to the db
    $result = $mysqli -> query($sql);
    // Fetch data (MYSQLI_ASSOC makes a key value array for each row)
    $rows = $result -> fetch_all(MYSQLI_ASSOC);

    // Loop through the results if there's a full associations of username and hased password return 
    foreach($rows as $row) {
        if ($row['username'] === $_POST['username'] && password_verify($_POST['password'], $row['password'])) {
            $_SESSION['login_message'] = 'You succesfully logged in!';
            header('Location: index.php');
            exit();
        } else {
            $_SESSION['login_message'] = 'Your email or password is incorrect! Please try again.';
            header('Location: login_form.php');
            exit;
        };
    }
?>