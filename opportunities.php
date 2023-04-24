<!DOCTYPE html>
<html lang="en">

<head>
    <title>careerWise | Opportunities</title>
    <link rel="stylesheet" type="text/css" href="Style/content.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=K2D:wght@100&display=swap" rel="stylesheet" />
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen" />
    <style>
        .search-form {
            display: flex;
            justify-content: center;
        }
    </style>
</head>

<body>
    <div id="main">
        <script src="https://code.jquery.com/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <div id="menu">
            <?php include 'navBar.php'; ?>
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

            if(isset($_POST['submit'])){
                $search = $_POST['search'];
                $query = "SELECT v.vacancy_id, b.company, v.position, v.salary_range FROM vacancies v JOIN business b ON v.company_id = b.company_id WHERE v.position LIKE '%$search%' OR v.salary_range LIKE '%$search%' OR b.company LIKE '%$search%' OR v.vacancy_id LIKE '%$search%'";
                $result = mysqli_query($connection, $query);
                $queryResult = mysqli_num_rows($result);
                
                if($queryResult > 0){
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "Vacancy: " . $row["vacancy_id"] . "<br>";
                        echo "Company: " . $row["company"] . "<br>";
                        echo "Position: " . $row["position"] . "<br>";
                        echo "Salary Range: " . $row["salary_range"] . "<br>";
                        echo "<br><br>";
                    }
                } else {
                    echo "There are no results matching your search!";
                }
            } else {
                $query = "SELECT v.vacancy_id, b.company, v.position, v.salary_range FROM vacancies v JOIN business b ON v.company_id = b.company_id";
                $result = mysqli_query($connection, $query);
            
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "Vacancy: " . $row["vacancy_id"] . "<br>";
                    echo "Company: " . $row["company"] . "<br>";
                    echo "Position: " . $row["position"] . "<br>";
                    echo "Salary Range: " . $row["salary_range"] . "<br>";
                    echo "<br><br>";
                }
            }
            
            // Close the database connection
            mysqli_close($connection);
            ?>
        </div>
        <form method="post" class="search-form">
            <label>Search</label>
            <input type="text" name="search">
            <input type="submit" name="submit">
        </form>
    </div>
</div>

    </div>
</body>

</html>
