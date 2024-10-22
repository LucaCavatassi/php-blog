<html>
    <body>

    <?php
        // New object that create a connection to the db
        $mysqli = new mysqli("localhost","root","root","my_blog_db");

        // Check connection
        if ($mysqli -> connect_errno) {
            echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
            // Redirect to index.php
            header("Location: index.php");
            exit();
        }

        // Query
        $sql = "SELECT * FROM users";
        // Result it the query applied to the db
        $result = $mysqli -> query($sql);
        // Fetch data (MYSQLI_ASSOC makes a key value array for each row)
        $rows = $result -> fetch_all(MYSQLI_ASSOC);

        foreach($rows as $row) {
            if ($row['username'] === $_POST['username'] && ) {
                var_dump('good');
            };
        }
    ?>
    </body>
</html>