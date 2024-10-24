<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>My Blog</title>

        <!-- BOOTSTRAP -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <!-- BOOTSTRAP -->
        
        <!-- CSS -->
        <link rel="stylesheet" href="style.css">
        <!-- CSS -->
    </head>

    <body>
        <!-- Header -->
        <header>
            <div class="container py-2 d-flex justify-content-between align-items-center">
                <a href="home_page.php"><h1 class="text-white">My Blog</h1></a>
        
                <nav>
                    <?php 
                        session_start();
                        // var_dump($_SESSION);
                        if (isset($_SESSION['user_id'])) {
                            echo '<a class="btn btn-secondary me-4" href="create_post_page.php">&plus; Add Post</a>';
                            echo '<a class="btn btn-success" href="manage_post_page.php">Manage Posts</a>';
                            echo '<form action="logout.php" method="POST" class="d-inline"><button class="ms-4 btn btn-primary">Logout</button></form>';
                        } else {
                            echo '<a class="btn btn-secondary" href="register_page.php">Register</a>';
                            echo '<a class="btn btn-primary" href="login_page.php">Login</a>';
                        }
                    ?>
                </nav>
            </div>
        </header>
        <!-- Header -->

        <!-- Get messages from session and print with bootstrap alerts -->
        <?php
            // var_dump($_SESSION);
            // If error message has been set print it
            if (isset($_SESSION['error_message'])) {
                echo '<div class="container mt-5 alert alert-danger" role="alert" id="errorMessage">' . $_SESSION['error_message'] . '</div>';
                unset($_SESSION['error_message']);
            }
            // If login message has been set print it
            if (isset($_SESSION['login_message']) && $_SESSION['login_message'] === "You successfully logged in!") { // Fixed typo
                echo '<div class="container mt-5 alert alert-success" role="alert" id="loginMessage">' . $_SESSION['login_message'] . '</div>';
                unset($_SESSION['login_message']);
            } else if (isset($_SESSION['login_message']) && $_SESSION['login_message'] === "Your username or password is incorrect! Please try again.") {
                echo '<div class="container mt-5 alert alert-danger" role="alert" id="loginMessage">' . $_SESSION['login_message'] . '</div>';
                unset($_SESSION['login_message']);
            }  else if (isset($_SESSION['login_message']) && $_SESSION['login_message'] === "Please provide both username and password.") {
                echo '<div class="container mt-5 alert alert-warning" role="alert" id="loginMessage">' . $_SESSION['login_message'] . '</div>';
                unset($_SESSION['login_message']);
            } else if (isset($_SESSION['login_message']) && $_SESSION['login_message'] === "You have successfully logged out.") {
                echo '<div class="container mt-5 alert alert-primary" role="alert" id="loginMessage">' . $_SESSION['login_message'] . '</div>';
                unset($_SESSION['login_message']);
            }

            if (isset($_SESSION['success_message'])) {
                echo '<div class="container mt-5 alert alert-success" role="alert" id="errorMessage">' . $_SESSION['success_message'] . '</div>';
                unset($_SESSION['success_message']);
            }
        ?>
        <!-- Get messages from session and print with bootstrap alerts -->
            
        <!-- JS to hide alerts -->
        <script>
            setTimeout(function() {
                const errorMessage = document.getElementById('errorMessage');
                const loginMessage = document.getElementById('loginMessage');
                
                if (errorMessage) {
                    errorMessage.style.display = 'none'; // Hide the error message
                }
                
                if (loginMessage) {
                    loginMessage.style.display = 'none'; // Hide the login message
                }
            }, 3000);
        </script>
        <!-- JS to hide alerts -->
    </body>
</html>