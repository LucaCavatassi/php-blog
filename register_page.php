<?php include 'layout.php'; ?>

<div class="container mt-5">
    <h1 class="fs-2">Register</h1>
    <div class="d-flex justify-content-between align-items-center">
        <span class="text-secondary">Please enter a username and a password</span>
        <span class="text-secondary">Fields with * are necessary</span>
    </div>

    <!-- On action the file that handles the registration -->
    <form class="ms-form" action="register.php" method="POST">
        <div class="mb-3">
            <label for="username" class="form-label fw-bold">Username*</label>
            <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label fw-bold">Password*</label>
            <input type="password" id="password" name="password" class="form-control" minlength="8" >
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
    </form>
</div>

