<!DOCTYPE html>
<html lang="en">

<head>
    <title>careerWise | Company Page</title>
    <link rel="stylesheet" type="text/css" href="Style/content.css" />
    <link rel="stylesheet" type="text/css" href="Style/profilePage.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=K2D:wght@100&display=swap" rel="stylesheet" />
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen" />
</head>

<body>
    <div id="main">
        <script src="https://code.jquery.com/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <?php
        require_once 'userData.php';
        $hostName = "sql109.epizy.com";
        $userName = "epiz_33784251";
        $password = "XzX7r5XomWU";
        $databaseName = "epiz_33784251_cs4116";
        $connection = mysqli_connect($hostName, $userName, $password, $databaseName);

        // get company id
        if (isset($_GET['companyid'])) {
            $companyId = $_GET['companyid'];
            $companyDetails = getCompanyDetails($connection, $companyId);
            $_POST['companyDetails'] = $companyDetails;
        } else {
            session_start();
            $companyId = $_SESSION['company_id'];
            $companyDetails = getCompanyDetails($connection, $companyId);
            $_POST['companyDetails'] = $companyDetails;
        }

        //check if company is banned
        $sql = "SELECT * FROM banned WHERE company_id = $companyId";
        $result = mysqli_query($connection, $sql);
        $banned = mysqli_num_rows($result) > 0;
        mysqli_close($connection);
        ?>
        <div id="menu">
            <?php include 'navBar.php'; ?>
        </div>

        <div id="content">
            <div id="profilePage">
                <img id="userProfilePicture" src="assets/profilePicture.svg" alt="user avatar" />
                <div id="header">
                    <h2><?php echo $_POST['companyDetails']["company"]; ?></h2>
                    <?php
                    if ($banned) {
                        echo '<span class="label label-important">Banned</span>';
                    } else {
                        echo '<button type="button" class="btn btn-primary">Follow +</button>';
                    }
                    ?>
                </div>
                <div id="body">
                    <div id="left">
                        <h3>Employees</h3>
                        <?php
                        $company = $_POST['companyDetails']["company"];
                        $sql = "SELECT * FROM users WHERE company = '$company'";
                        $connection = mysqli_connect($hostName, $userName, $password, $databaseName);
                        $result = mysqli_query($connection, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<p>";
                                echo "Name: " . $row["FirstName"] . " " . $row["LastName"] . "<br>";
                                echo "<a href='profilePage.php?userId=" . $row["user_id"] . "'>View Profile</a>";
                                echo "</p>";
                            }
                        } else {
                            echo "No Employees :(";
                        }
                        mysqli_close($connection);
                        ?>
                    </div>


                    <div id="right">
                        <h3>Vacancies</h3>
                        <?php
                        $sql = "SELECT * FROM vacancies WHERE company_id = $companyId";
                        $connection = mysqli_connect($hostName, $userName, $password, $databaseName);
                        $result = mysqli_query($connection, $sql);

                        if ($result > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "Position: " . $row["position"] . "<br>";
                                echo "Salary Range: " . $row["salary_range"] . "<br>";
                                echo "<br><br>";
                            }
                        } else {
                            echo "There are no current vacancies :(";
                        }
                        mysqli_close($connection);
                        ?>
                    </div>


                </div>
                <div>
                </div>
            </div>
        </div>
        <!-- if session[admin]=true -->
        <?php
        session_start();
        if ($_SESSION['admin'] == true) {
            echo '<div id="content"><div id="adminControls">
            <h2>Admin Controls</h2>
            <form method="post">
            <button type="submit" class="btn btn-primary" name="ban">Ban Account</button>
            <button type="submit" class="btn btn-primary" name="pardon">Pardon Account</button>
            </form>
        </div></div>';
            if (isset($_POST['ban'])) {
                $sql = "SELECT * FROM banned WHERE company_id = $companyId";
                $connection = mysqli_connect($hostName, $userName, $password, $databaseName);
                $result = mysqli_query($connection, $sql);
                // if the user is not already banned, insert a new row into the "banned" table
                if (mysqli_num_rows($result) == 0) {
                    $sql = "INSERT INTO banned (user_id, company, company_id) VALUES (0, null, $companyId)";
                    mysqli_query($connection, $sql);
                }
                mysqli_close($connection);
            }
            if (isset($_POST['pardon'])) {
                $sql = "DELETE FROM banned WHERE company_id = $companyId";
                $connection = mysqli_connect($hostName, $userName, $password, $databaseName);
                $result = mysqli_query($connection, $sql);
                mysqli_query($connection, $sql);
                mysqli_close($connection);
            }
        }
        ?>
    </div>
</body>

</html>