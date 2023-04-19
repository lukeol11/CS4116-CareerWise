<!DOCTYPE html>
<html lang="en">

<head>
    <title>careerWise | Profile Page</title>
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
        if (isset($_GET['userid'])) {
            $userId = $_GET['userid'];
            $userDetails = getUserDetails($connection, $userId);
            $_POST['userDetails'] = $userDetails;
        } else {
            session_start();
            $userId = $_SESSION['user_id'];
            $userDetails = getUserDetails($connection, $userId);
            $_POST['userDetails'] = $userDetails;
        }
        //check if user is banned
        $sql = "SELECT * FROM banned WHERE user_id = $userId";
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
                    <h2><?php echo $_POST['userDetails']["FirstName"] . " " . $_POST['userDetails']["LastName"]; ?></h2>
                    <p><?php echo $_POST['userDetails']["company"]; ?></p>
                    <?php
                    if ($banned) {
                        echo '<span class="label label-important">Banned</span>';
                    } else {
                        echo '<button type="button" class="btn btn-primary">Add Friend +</button>';
                    }
                    ?>
                </div>
                <div id="body">
                    <div id="left">
                        <h3>Employment History</h3>
                        <?php
                        $sql = "SELECT * FROM employment_history WHERE user_id = $userId";
                        $connection = mysqli_connect($hostName, $userName, $password, $databaseName);
                        $result = mysqli_query($connection, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<p>";
                                echo "Company: " . $row["company"] . "<br>";
                                echo "Position: " . $row["position"] . "<br>";
                                echo $row["start_date"] . " - " . $row["end_date"] . "<br>";
                                echo "</p>";
                            }
                        } else {
                            echo "No Employment History";
                        }
                        mysqli_close($connection);
                        ?>
                    </div>
                    <div id="right">
                        <h3>Education & Qualifications</h3>
                        <?php
                        $sql = "SELECT * FROM education_history WHERE user_id = $userId";
                        $connection = mysqli_connect($hostName, $userName, $password, $databaseName);
                        $result = mysqli_query($connection, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<p>";
                                echo "School: " . $row["school"] . "<br>";
                                echo "Course: " . $row["course"] . "<br>";
                                echo $row["start_date"] . "-" . $row["end_date"] . "<br>";
                                echo "</p>";
                            }
                        } else {
                            echo "No Education History";
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
            <button type="submit" class="btn btn-primary" name="ban">Ban User</button>
            <button type="submit" class="btn btn-primary" name="pardon">Pardon User</button>
            <button type="submit" class="btn btn-primary" name="promote">Make Admin</button>
            <button type="submit" class="btn btn-primary" name="demote">Make User</button>
            </form>
        </div></div>';
            if (isset($_POST['ban'])) {
                $sql = "SELECT * FROM banned WHERE user_id = $userId";
                $connection = mysqli_connect($hostName, $userName, $password, $databaseName);
                $result = mysqli_query($connection, $sql);
                // if the user is not already banned, insert a new row into the "banned" table
                if (mysqli_num_rows($result) == 0) {
                    $sql = "INSERT INTO banned (user_id, company, company_id) VALUES ($userId, null, null)";
                    mysqli_query($connection, $sql);
                }
                mysqli_close($connection);
            }
            if (isset($_POST['pardon'])) {
                $sql = "DELETE FROM banned WHERE user_id = $userId";
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