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
    <header style="background-color:cornflowerblue;" >
        <div class="container py-2 d-flex justify-content-between align-items-center">
            <h1 class="text-white">My Blog</h1>
    
            <nav>
                <a class="btn btn-primary" href="login_form.php">Login</a>
            </nav>
        </div>
    </header>





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