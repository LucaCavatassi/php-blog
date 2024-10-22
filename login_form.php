<html>
    <body>
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
        <!-- On action the file that handles the login -->
        <form action="login.php" method="POST">
            <label for="username">Username</label>
            <input type="text" id="username" name="username">
            <label for="password">Password</label>
            <input type="text" id="password" name="password">
            <button type="submit">Login</button>
        </form>
    </body>
</html>
