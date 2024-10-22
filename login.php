<html>
    <body>

    <?php
        $mysqli = new mysqli("localhost","root","root","my_blog_db");

        // Check connection
        if ($mysqli -> connect_errno) {
            echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
            exit();
        }

        // Query
        $sql = "SELECT * FROM users";
        // Result it the query applied to the db
        $result = $mysqli -> query($sql);
        // Fetch data (MYSQLI_ASSOC makes a key value array for each row)
        $rows = $result -> fetch_all(MYSQLI_ASSOC);

        var_dump($rows);
    ?>

    </body>
</html>