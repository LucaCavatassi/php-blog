<?php include 'layout.php'; ?>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="fs-4">Please enter username and password</h1>
        <span class="text-secondary">Fields with * are necessary</span>
    </div>

    <!-- On action the file that handles the login -->
    <form class="ms-form" action="login.php" method="POST">
        <div class="mb-3">
            <label for="username" class="form-label fw-bold">Username*</label>
            <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label fw-bold">Password*</label>
            <input type="password" id="password" name="password" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>

