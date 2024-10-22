<?php include 'layout.php'; ?>

    <!-- On action the file that handles the login -->
    <form class="form-group" action="login.php" method="POST">
        <label for="username">Username</label>
        <input type="text" id="username" name="username">
        <label for="password">Password</label>
        <input type="text" id="password" name="password">
        <button type="submit">Login</button>
    </form>

