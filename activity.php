<!DOCTYPE html>
<html lang="en">

<head>
    <title>careerWise | Activity</title>
    <link rel="stylesheet" type="text/css" href="Style/content.css" />
    <link rel="stylesheet" type="text/css" href="Style/activity.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=K2D:wght@100&display=swap" rel="stylesheet" />
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen" />
</head>

<body>
    <div id="main">
        <script src="https://code.jquery.com/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <div id="menu">
            <?php include 'navBar.php'; ?>
        </div>

        <div id="content">
            <div id="activity">
                <h2> Activity </h2>
                <h3>Create a post</h3>


            </div>
        </div>
        <?php
        $hostName = "sql109.epizy.com";
        $userName = "epiz_33784251";
        $password = "XzX7r5XomWU";
        $databaseName = "epiz_33784251_cs4116";
        $connection = mysqli_connect($hostName, $userName, $password, $databaseName);

        $query = "SELECT posts.subject, posts.content, users.FirstName, users.LastName FROM posts INNER JOIN users ON posts.user_id = users.user_id";
        $result = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            echo '
                    <div id="content" style="min-height:5em">
                    <div id="post">
                    ';
            echo "Name: " . $row["FirstName"] . " " . $row["LastName"] . "<br>";
            echo "Subject: " . $row["subject"] . "<br>";
            echo "Content: " . $row["content"] . "<br>";
            echo "<br>";
            echo '
                    </div>
                    </div>
                    ';
        }

        // Close the database connection
        mysqli_close($connection);
        ?>
    </div>
</body>

</html>