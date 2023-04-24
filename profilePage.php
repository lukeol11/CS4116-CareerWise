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

                        <!-- if user admin or owner of page allow adding of positions -->
                        <?php
                        session_start();
                        if ($_SESSION['admin'] == true || $userId == $_SESSION['user_id']) {
                            echo '<h3> Add Employment History</h3>
                            <form method="post">
                                <input type="text" name="company" placeholder="Company" required>
                                <input type="text" name="position" placeholder="Position" required>
                                <input type="date" name="employment_start_date" placeholder="Start" required>
                                <input type="date" name="employment_end_date" placeholder="End" required>
                                <button type="submit" class="btn btn-primary" name="addEmployment">Add +</button>
                            </form>';
                        }

                        if (isset($_POST['addEmployment'])) {
                            $connection = mysqli_connect($hostName, $userName, $password, $databaseName);
                            $company = mysqli_real_escape_string($connection, $_POST['company']);
                            $position = mysqli_real_escape_string($connection, $_POST['position']);
                            $start_date = mysqli_real_escape_string($connection, $_POST['employment_start_date']);
                            $end_date = mysqli_real_escape_string($connection, $_POST['employment_end_date']);

                            $sql = "INSERT INTO employment_history (user_id, company_id, company, position, start_date, end_date) VALUES ('$userId', 0, '$company', '$position', '$start_date', '$end_date')";
                            $result = mysqli_query($connection, $sql);

                            if ($result) {
                                echo "Data inserted successfully!";
                            } else {
                                echo "Error: " . mysqli_error($connection) . " (" . mysqli_errno($connection) . ")";
                            }
                            mysqli_close($connection);
                        }
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

                        <!-- if user admin or owner of page allow adding of education -->
                        <?php
                        session_start();
                        if ($_SESSION['admin'] == true || $userId == $_SESSION['user_id']) {
                            echo '<h3> Add Education & Qualifications</h3>
                            <form method="post">
                                <input type="text" name="school" placeholder="University" required>
                                <input type="text" name="course" placeholder="Course" required>
                                <input type="date" name="education_start_date" placeholder="Start" required>
                                <input type="date" name="education_end_date" placeholder="End" required>
                                <button type="submit" class="btn btn-primary" name="addEducation">Add +</button>
                            </form>';
                        }

                        if (isset($_POST['addEducation'])) {
                            $connection = mysqli_connect($hostName, $userName, $password, $databaseName);
                            $school = mysqli_real_escape_string($connection, $_POST['school']);
                            $course = mysqli_real_escape_string($connection, $_POST['course']);
                            $start_date = mysqli_real_escape_string($connection, $_POST['education_start_date']);
                            $end_date = mysqli_real_escape_string($connection, $_POST['education_end_date']);

                            $sql = "INSERT INTO education_history (course_id, user_id, school, course, start_date, end_date) VALUES (null, '$userId', '$school', '$course', '$start_date', '$end_date')";
                            $result = mysqli_query($connection, $sql);

                            if ($result) {
                                echo "Data inserted successfully!";
                            } else {
                                echo "Error: " . mysqli_error($connection) . " (" . mysqli_errno($connection) . ")";
                            }
                            mysqli_close($connection);
                        }
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
            if (isset($_POST['promote'])) {
                // Check if the user already exists in the user_type table
                $connection = mysqli_connect($hostName, $userName, $password, $databaseName);
                $sql = "SELECT * FROM user_type WHERE user_id=$userId";
                $result = mysqli_query($connection, $sql);
                // If the user exists, update the user_type column to "Admin"
                if (mysqli_num_rows($result) > 0) {
                    $sql = "UPDATE user_type SET User_type='Admin' WHERE user_id=$userId";
                    mysqli_query($connection, $sql);
                } else {
                    // If the user does not exist, insert a new row into the user_type table with User_type as "Admin"
                    $sql = "INSERT INTO user_type (user_id, Email, User_type) VALUES ($userId, null, 'Admin')";
                    mysqli_query($connection, $sql);
                }
                mysqli_close($connection);
            }
            if (isset($_POST['demote'])) {
                // Check if the user already exists in the user_type table
                $connection = mysqli_connect($hostName, $userName, $password, $databaseName);
                $sql = "SELECT * FROM user_type WHERE user_id=$userId";
                $result = mysqli_query($connection, $sql);
                // If the user exists, update the user_type column to "User"
                if (mysqli_num_rows($result) > 0) {
                    $sql = "UPDATE user_type SET User_type='User' WHERE user_id=$userId";
                    mysqli_query($connection, $sql);
                } else {
                    // If the user does not exist, insert a new row into the user_type table with User_type as "User"
                    $sql = "INSERT INTO user_type (user_id, Email, User_type) VALUES ($userId, null, 'User')";
                    mysqli_query($connection, $sql);
                }
                mysqli_close($connection);
            }
        }
        ?>
    </div>
</body>

</html>