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
            <div id="people">
                <form action="submit_vacancy.php" method="POST">
                    <label for="company">Company:</label>
                    <input type="text" name="company" id="company" required>
                    <br>
                    <label for="position">Position:</label>
                    <input type="text" name="position" id="position" required>
                    <br>
                    <label for="salary_range">Salary Range:</label>
                    <input type="text" name="salary_range" id="salary_range" required>
                    <br>
                    <button type="submit">Submit</button>
                </form>

                <?php
                $hostName = "sql109.epizy.com";
                $userName = "epiz_33784251";
                $password = "XzX7r5XomWU";
                $databaseName = "epiz_33784251_cs4116";
                $connection = mysqli_connect($hostName, $userName, $password, $databaseName);

                if (isset($_POST['submit'])) {
                    //information for user
                    $company = mysqli_real_escape_string($connection, $_POST['company']);
                    $position = mysqli_real_escape_string($connection, $_POST['position']);
                    $salary = mysqli_real_escape_string($connection, $_POST['salary_range']);
                    mysqli_begin_transaction($connection);

                    // Insert into vacancies table
                    $query1 = "INSERT INTO vacancies (position, salary_range) VALUES ('$position', '$salary')";
                    if (!mysqli_query($connection, $query1)) {
                        echo "Error: " . $query1 . "<br>" . mysqli_error($connection);
                        mysqli_rollback($connection);
                        exit();
                    }

                    // Insert into business table
                    $query2 = "INSERT INTO business (company) VALUES ('$company')";
                    if (!mysqli_query($connection, $query2)) {
                        echo "Error: " . $query2 . "<br>" . mysqli_error($connection);
                        mysqli_rollback($connection);
                        exit();
                    }
                    // Commit transaction
                    mysqli_commit($connection);
                }
                // Close the database connection
                mysqli_close($connection);
                ?>
            </div>
        </div>
    </div>

    </div>
</body>

</html>