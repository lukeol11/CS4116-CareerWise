<!DOCTYPE html>
<html lang="en">

<head>
    <title>careerWise | Opportunities</title>
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
            <div id="people">
                <?php
                $hostName = "sql109.epizy.com";
                $userName = "epiz_33784251";
                $password = "XzX7r5XomWU";
                $databaseName = "epiz_33784251_cs4116";
                $connection = mysqli_connect($hostName, $userName, $password, $databaseName);

                $query = "SELECT * FROM vacancies";
                $result = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "Vacancy: " . $row["vacancy_id"] . "<br>";
                    echo "Company: " . $row["company_id"] . "<br>";
                    echo "Position: " . $row["position"] . "<br>";
                    echo "Salary Range: " . $row["salary_range"] . "<br>";
                    // echo "<a href='profilePage.php?userid=" . $row["user_id"] . "'>View Profile</a>";
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