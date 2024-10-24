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
    <!-- TITLE -->
    <div class="d-flex justify-content-between align-items-center my-3">
        <h1 class="fs-1 mb-0">Create new post</h1>
        <span class="text-secondary align-self-end">Fields with * are necessary</span>
    </div>
    <!-- TITLE -->

    <!-- FORM -->
    <form class="ms-form" action="create_post.php" method="POST">
        <!-- Title -->
        <div class="mb-3">
            <label for="title" class="form-label fw-bold">Title*</label>
            <!-- Value: if session form data title is set, so it's been sent and went back because
                there was some error in the submission, use that, else keep it empty -->
            <input type="text" class="form-control" id="title" name="title"
                value="<?php echo isset($_SESSION['form_data']['title']) ? $_SESSION['form_data']['title'] : ''; ?>">
        </div>
        <!-- Title -->

        <!-- Description -->
        <div class="mb-3">
            <label for="content" class="form-label fw-bold">Content*</label>
            <textarea type="text" id="content" name="content" class="form-control">
                <!-- This works the same as title, if set use it else empty -->
                <?php echo isset($_SESSION['form_data']['content']) ? $_SESSION['form_data']['content'] : ''; ?>
            </textarea>
        </div>
        <!-- Description -->

        <!-- Author/User -->
        <div class="mb-3">
            <label for="user_id" class="form-label fw-bold">Author*</label>
            <select id="user_id" name="user_id" class="form-select" aria-label="select-author">
                <!-- This is the grey select an author unclickable option
                if it's not been set user_id as was for title apply selected attribute so it shows 
                else nothing, use echo cause it need to be printed  -->
                <option value="" <?php echo !isset($_SESSION['form_data']['user_id']) ? 'selected' : ''; ?> disabled>Select author</option>

                <!-- Loop each user to show and select which one it's the author
                this is been thinked as this cause i thought maybe someone can have a master account manging more users -->
                <?php
                foreach ($rowsUsers as $user) {
                    // Set selected if the user_id from the session matches the current user's id
                    // If is set and matches the current element in the foreach loop, it's the one so it's the selected
                    $selected = (isset($_SESSION['form_data']['user_id']) && $_SESSION['form_data']['user_id'] == $user['id']) ? 'selected' : '';
                    // Print the option with the value of the id of the user, and user userename, and also the selected that if conditions are met will be selected
                    echo '<option value="' . $user['id'] . '" ' . $selected . '>' . htmlspecialchars($user['username']) . '</option>';
                }
                ?>
            </select>
        </div>
        <!-- Author/User -->

        <!-- Category -->
        <div class="mb-3">
            <!-- Equal to author same logic  -->
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
        <!-- Category -->

        <!-- Submit -->
        <button type="submit" class="btn btn-primary">Create Post</button>
        <!-- Submit -->
    </form>
    <!-- FORM -->
</div>

<?php
// Clear the form data after displaying it so on refresh the form it's empty
if (isset($_SESSION['form_data'])) {
    unset($_SESSION['form_data']);
} ?>