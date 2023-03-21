<div id="profilePage">
    <?php
    require_once 'userData.php';
    $hostName = "sql109.epizy.com";
    $userName = "epiz_33784251";
    $password = "XzX7r5XomWU";
    $databaseName = "epiz_33784251_cs4116";
    $connection = mysqli_connect($hostName, $userName, $password, $databaseName);
    $userId = 1;
    $userDetails = getUserDetails($connection, $userId);
    $_POST['userDetails'] = $userDetails;
    mysqli_close($connection);
    ?>
    <link rel="stylesheet" type="text/css" href="Style/profilePage.css" />
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