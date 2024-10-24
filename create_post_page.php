<?php include('layout.php') ?>

<?php
// New object that create a connection to the db
$mysqli = new mysqli("localhost", "root", "root", "my_blog_db");

// Query build
$sqlUsers = "SELECT *
            FROM users";
// Result it's the query applied to the db
$resultUsers = $mysqli->query($sqlUsers);
// Fetch data (MYSQLI_ASSOC makes a key value array for each row)
$rowsUsers = $resultUsers->fetch_all(MYSQLI_ASSOC);

$sqlCategories = "SELECT * FROM categories";
// Result it's the query applied to the db
$resultCat = $mysqli->query($sqlCategories);
// Fetch data (MYSQLI_ASSOC makes a key value array for each row)
$rowsCat = $resultCat->fetch_all(MYSQLI_ASSOC);
?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center my-3">
        <h1 class="fs-1 mb-0">Create new post</h1>
        <span class="text-secondary align-self-end">Fields with * are necessary</span>
    </div>


    <form class="ms-form" action="create_post.php" method="POST">
        <div class="mb-3">
            <label for="title" class="form-label fw-bold">Title*</label>
            <input type="text" class="form-control" id="title" name="title"
                value="<?php echo isset($_SESSION['form_data']['title']) ? $_SESSION['form_data']['title'] : ''; ?>">
        </div>
        <div class="mb-3">
            <label for="content" class="form-label fw-bold">Content*</label>
            <textarea type="text" id="content" name="content" class="form-control"><?php echo isset($_SESSION['form_data']['content']) ? $_SESSION['form_data']['content'] : ''; ?></textarea>
        </div>
        <div class="mb-3">
            <label for="user_id" class="form-label fw-bold">Author*</label>
            <select id="user_id" name="user_id" class="form-select" aria-label="select-author">
                <option value="" <?php echo !isset($_SESSION['form_data']['user_id']) ? 'selected' : ''; ?> disabled>Select author</option>
                <?php
                foreach ($rowsUsers as $user) {
                    // Set selected if the user_id from the session matches the current user's id
                    $selected = (isset($_SESSION['form_data']['user_id']) && $_SESSION['form_data']['user_id'] == $user['id']) ? 'selected' : '';
                    echo '<option value="' . $user['id'] . '" ' . $selected . '>' . htmlspecialchars($user['username']) . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="category_id" class="form-label fw-bold">Category*</label>
            <select id="category_id" name="category_id" class="form-select" aria-label="select-author">
                <option value="" <?php echo !isset($_SESSION['form_data']['category_id']) ? 'selected' : ''; ?> disabled>Select category</option>
                <?php
                foreach ($rowsCat as $categories) {
                    // Set selected if the category_id from the session matches the current category's id
                    $selected = (isset($_SESSION['form_data']['category_id']) && $_SESSION['form_data']['category_id'] == $categories['id']) ? 'selected' : '';
                    echo '<option value="' . $categories['id'] . '" ' . $selected . '>' . htmlspecialchars($categories['name']) . '</option>';
                }
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Create Post</button>
    </form>
</div>

<?php
// Clear the form data after displaying it
if (isset($_SESSION['form_data'])) {
    unset($_SESSION['form_data']);
} ?>