<?php include 'layout.php'; ?>

<div class="container mt-5">
    <!-- On action the file that handles the login -->
    <form action="login.php" method="POST">
        <div class="mb-3">
            <label for="username" class="form-label fw-bold">Username</label>
            <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label fw-bold">Password</label>
            <input type="password" id="password" name="password" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>

