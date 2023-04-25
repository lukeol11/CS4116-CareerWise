<!DOCTYPE html>
<html lang="en">

<head>
    <title>careerWise | Search Results</title>
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
                    echo "Error";
                }

                $result = mysqli_query($connection, $query);
                if (mysqli_num_rows($result) == 0) {
                    echo "There are no people matching your query :(";
                } else {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "Name: " . $row["FirstName"] . " " . $row["LastName"] . "<br>";
                        echo "Company: " . $row["company"] . "<br>";
                        echo "<a href='profilePage.php?userid=" . $row["user_id"] . "'>View Profile</a>";
                        echo "<br><br>";
                    }
                }

                // Close the database connection
                mysqli_close($connection);
                ?>
            </div>
        </div>

        <div id="content">
            <div id="companies">
                <h2> Companies </h2>
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
                    $query = "SELECT * FROM business WHERE company LIKE '%$search_query%'";
                    $result = mysqli_query($connection, $query);
                    if (mysqli_num_rows($result) == 0) {
                        echo "There are no companies matching your query :(";
                    } else {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "Company: " . $row["company"] . "<br>";
                            echo "<a href='companyPage.php?companyid=" . $row["company_id"] . "'>View Profile</a>";
                            echo "<br><br>";
                        }
                    }

    
                    // Close the database connection
                    mysqli_close($connection);
                } else {
                    echo "Error";
                }

                ?>



            </div>
        </div>

        <div id="content">
        <div id="opportunities">
            <h2> Opportunities </h2>
            <?php
            $hostName = "sql109.epizy.com";
            $userName = "epiz_33784251";
            $password = "XzX7r5XomWU";
            $databaseName = "epiz_33784251_cs4116";
            $connection = mysqli_connect($hostName, $userName, $password, $databaseName);

            if (isset($_GET["query"])) {
                $search = $_GET["query"];
                $query = "SELECT b.company, v.position, v.salary_range FROM vacancies v JOIN business b ON v.company_id = b.company_id WHERE v.position LIKE '%$search%' OR v.salary_range LIKE '%$search%' OR b.company LIKE '%$search%'";
                $result = mysqli_query($connection, $query);
                $queryResult = mysqli_num_rows($result);
                
                if($queryResult > 0){
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "Company: " . $row["company"] . "<br>";
                        echo "Position: " . $row["position"] . "<br>";
                        echo "Salary Range: " . $row["salary_range"] . "<br>";
                        echo "<br><br>";
                    }
                } else {
                    echo "There are no opportunities matching your query :(";
                }
            }
            
            // Close the database connection
            mysqli_close($connection);
            ?>
        </div>

    </div>
</body>

</html>