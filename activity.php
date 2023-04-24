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
                <form method="post">
                    <input type="text" name="subject" placeholder="Subject" required style="width: 25%">
                    <br>
                    <textarea name="content" rows="10" placeholder="Content" required style="width: 60%"></textarea>
                    <br>
                    <button type="submit" class="btn btn-primary" name="makePost">Post</button>
                </form>

                <?php
                $hostName = "sql109.epizy.com";
                $userName = "epiz_33784251";
                $password = "XzX7r5XomWU";
                $databaseName = "epiz_33784251_cs4116";
                if (isset($_POST['makePost'])) {
                    $connection = mysqli_connect($hostName, $userName, $password, $databaseName);
                    $subject = mysqli_real_escape_string($connection, $_POST['subject']);
                    $content = mysqli_real_escape_string($connection, $_POST['content']);

                    session_start();
                    $userId = $_SESSION['user_id'];

                    $sql = "INSERT INTO posts (id, user_id, subject, content) VALUES (null, '$userId', '$subject', '$content')";
                    $result = mysqli_query($connection, $sql);

                    if ($result) {
                        echo "Post Made successfully!";
                    } else {
                        echo "Error: " . mysqli_error($connection) . " (" . mysqli_errno($connection) . ")";
                    }
                    mysqli_close($connection);
                }
                ?>

            </div>
        </div>


        <!-- admin controls -->
        <?php
        session_start();
        if ($_SESSION['admin'] == true) {
            echo '<div id="content"><div id="adminControls">
            <h2>Admin Controls</h2>
            <form method="post">
            <input type="text" name="postId" placeholder="Post Id" required style="width: 25%">
            <button type="submit" class="btn btn-primary" name="delete">Delete Post</button>
            </form>
        </div></div>';
            if (isset($_POST['delete'])) {
                $connection = mysqli_connect($hostName, $userName, $password, $databaseName);
                $id = mysqli_real_escape_string($connection, $_POST['postId']);
                $sql = "DELETE FROM posts WHERE id = '$id'";
                $result = mysqli_query($connection, $sql);
                if ($result) {
                    echo "Post Deleted successfully!";
                } else {
                    echo "Error: " . mysqli_error($connection) . " (" . mysqli_errno($connection) . ")";
                }
                mysqli_close($connection);
            }
        }
        ?>

        <!-- display posts -->
        <?php
        $connection = mysqli_connect($hostName, $userName, $password, $databaseName);

        $query = "SELECT posts.id, posts.subject, posts.content, users.FirstName, users.LastName, posts.postDate 
        FROM posts 
        INNER JOIN users ON posts.user_id = users.user_id
        ORDER BY posts.id DESC
        ";
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
            echo "Posted on: " . $row["postDate"] . "<br>";
            echo "Post Id: " . $row["id"] . "<br>";
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