<?php include('layout.php') ?>

<?php
// New object that create a connection to the db
$mysqli = new mysqli("localhost", "root", "root", "my_blog_db");

// Query build
$sql = "SELECT *
            FROM users";
// Result it's the query applied to the db
$result = $mysqli->query($sql);
// Fetch data (MYSQLI_ASSOC makes a key value array for each row)
$rows = $result->fetch_all(MYSQLI_ASSOC);

var_dump($rows);
?>

<div class="container mt-4">
    <h1>Create new post</h1>
    <form class="ms-form" action="create_post.php" method="POST">
        <div class="mb-3">
            <label for="title" class="form-label fw-bold">Title*</label>
            <input type="text" class="form-control" id="title" name="title">
        </div>
        <div class="mb-3">
            <label for="content" class="form-label fw-bold">Content*</label>
            <textarea type="text" id="content" name="content" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label for="user" class="form-label fw-bold">Author*</label>
            <select name="author" class="form-select" aria-label="select-author">
                <option value="" disabled selected>Select author</option>
                <?php
                foreach ($rows as $user) {
                    echo '<option value="' . $user['id'] . '">' . $user['username'] . '</option>';
                }
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>