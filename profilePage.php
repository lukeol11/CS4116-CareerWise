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
        session_start();
        $userId = $_SESSION['user_id'];
        $userDetails = getUserDetails($connection, $userId);
        $_POST['userDetails'] = $userDetails;
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
                    <button type="button" class="btn btn-primary">Add Friend +</button>
                </div>
                <div id="body">
                    <div id="left">
                        <h3>Employment History
                        </h3>
                        <p>{{education}}</p>
                    </div>
                    <div id="right">
                        <h3>Education & Qualifications</h3>
                        <p>{{educationQualifications}}</p>
                    </div>


                </div>
                <div>
                </div>
            </div>
</body>

</html>