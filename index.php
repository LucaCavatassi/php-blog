<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Blog</title>
</head>
<body>
<h1>Homepage</h1>
        <a href="login_form.php">Login</a>
        <!-- Print messages -->
        <?php
            // Start the session
            session_start();
            // If error message has been set print it
            if(isset($_SESSION['error_message'])) {
                echo $_SESSION['error_message'];
                unset ($_SESSION['error_message']);
            }
            // If login message has been set print it
            if (isset($_SESSION['login_message'])) {
                echo $_SESSION['login_message'];
                unset($_SESSION['login_message']);
            }
        
        ?>
</body>
</html>