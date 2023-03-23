<!DOCTYPE html>
<html lang="en">

<head>
  <title>careerWise | Login</title>
  <link rel="stylesheet" type="text/css" href="Style/menu.css" />
  <link rel="stylesheet" type="text/css" href="Style/template.css" />
  <link rel="stylesheet" type="text/css" href="Style/content.css" />
  <link rel="stylesheet" href="Style/login.css">
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
      <div class="navbar">
        <div class="navbar-inner">
          <a class="brand" href="#" style="border-right: none;">careerWise</a>
        </div>
      </div>
    </div>

    <div id="content">
      <div id="loginPage">

        <div class="container-fluid">
          <div class="row justify-content-center align-items-center">
            <div id="login-box">
              <h2>Welcome!</h2>
              <form method="post">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                <br>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <br>
                <button type="submit" class="btn btn-primary" name="login">Login</button>
                <a id="link" href="SignUp.php">New? Create an account now!</a>
              </form>

              <?php
              if (isset($_POST['login'])) {
                $hostName = "sql109.epizy.com";
                $email = "epiz_33784251";
                $password = "XzX7r5XomWU";
                $databaseName = "epiz_33784251_cs4116";
                $connection = mysqli_connect($hostName, $email, $password, $databaseName);
                $email = mysqli_real_escape_string($connection, $_POST['email']);
                $password = mysqli_real_escape_string($connection, $_POST['password']);
                $query = "SELECT * FROM users WHERE email = '$email' AND company = '$password'";
                $result = mysqli_query($connection, $query);
                if (mysqli_num_rows($result) == 1) {
                  // Get the user ID from the result and store it in a variable
                  $row = mysqli_fetch_assoc($result);
                  $user_id = $row['user_id'];

                  // Add the user ID to the session
                  session_start();
                  $_SESSION['user_id'] = $user_id;

                  echo "Login Successful... Redirecting";
                  header("Location: profilePage.php");
                } else {
                  echo "Login Failed";
                }
              }
              ?>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>