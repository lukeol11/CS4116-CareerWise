<!DOCTYPE html>
<html lang="en">

<head>
    <title>careerWise | People</title>
    <link rel="stylesheet" type="text/css" href="Style/content.css" />
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
            <div id="search">
                <form action="" method="get">
                    <input type="text" name="query" placeholder="Search">
                    <button class="btn btn-primary" type="submit">Go</button>
                </form>
            </div>

        </div>

        <div id="content">
            <div id="people">
                <h2> People </h2>
                <?php
                $hostName = "sql109.epizy.com";
                $userName = "epiz_33784251";
                $password = "XzX7r5XomWU";
                $databaseName = "epiz_33784251_cs4116";
                $connection = mysqli_connect($hostName, $userName, $password, $databaseName);

                // Check if a search query was submitted
                if (isset($_GET["query"])) {
                    $search_query = $_GET["query"];

                    // request based on search query
                    $query = "SELECT * FROM users WHERE FirstName LIKE '%$search_query%' OR LastName LIKE '%$search_query%' OR company LIKE '%$search_query%'";
                } else {
                    // else show all
                    $query = "SELECT * FROM users";
                }

                $result = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "Name: " . $row["FirstName"] . " " . $row["LastName"] . "<br>";
                    echo "Company: " . $row["company"] . "<br>";
                    echo "<a href='profilePage.php?userid=" . $row["user_id"] . "'>View Profile</a>";
                    echo "<br><br>";
                }

                // Close the database connection
                mysqli_close($connection);
                ?>



            </div>

        </div>

    </div>
</body>

</html>