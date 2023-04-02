<!DOCTYPE html>
<html lang="en">

<head>
  <title>careerWise | Sign Up</title>
  <link rel="stylesheet" type="text/css" href="Style/menu.css" />
  <link rel="stylesheet" type="text/css" href="Style/content.css" />
  <link rel="stylesheet" href="Style/SignUp.css">
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
      <div id="signUpPage">
       <h1>Create An Account</h1>
        <div class="signup-box">
          <div class="left-box">
            <h1> Basic Details</h1>
            <form method="POST">
              <input type="text" name="firstName" placeholder="First Name" required class="input-box">
              <input type="text" name="lastName" placeholder="Last Name" required class="input-box">
              <input type="email" name="email" placeholder="Email" required class="input-box">
              <input type="password" name="password" placeholder="Create Password" required class="input-box">
              <input type="password" name="confirmPassword" placeholder="Confirm Password" required class="input-box">
              <div class="checkbox">
                <input type="checkbox" id="terms" required>
                <label for "terms"> I accept the terms and conditions.</label>
              </div>
              <button class="btn-primary" name="submit" type="submit"> Create! <span> &#x27f6; </span></button>
            </form>
            <?php
            $dbhost = "sql109.epizy.com";
            $dbuser = "epiz_33784251";
            $dbpass = "XzX7r5XomWU";
            $dbname = "epiz_33784251_cs4116";

            $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

            if (mysqli_connect_errno()) {
              die('Could not connect: ' . mysqli_connect_error());
            }

            if (isset($_POST['submit'])) {
              $firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
              $lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
              $email = mysqli_real_escape_string($conn, $_POST['email']);
              $password = mysqli_real_escape_string($conn, $_POST['password']);
              $confirmPassword = mysqli_real_escape_string($conn, $_POST['confirmPassword']);

              // Check if passwords match
              if ($password != $confirmPassword) {
                echo "Error: Passwords do not match";
                exit();
              }

              // Check password length
              if (strlen($password) < 8) {
                echo "Error: Password must be at least 8 characters long";
                exit();
              }

              $query = "INSERT INTO users (firstName, lastName, email, password) VALUES ('$firstName', '$lastName', '$email', '$password')";
              if (mysqli_query($conn, $query)) {
                echo "New record created successfully";
              } else {
                echo "Error: " . $query . "<br>" . mysqli_error($conn);
              }
            }
            ?>
          </div>
          <div class="right-box">
            <h1> Jobs & Education</h1>
            <h3>Previous Company</h3>
            <form>
              <input type="text" placeholder="Company" required class="input-box">
              <input type="text" placeholder="Position" required class="input-box">
              <input type="date" placeholder="Start" required>
              <input type="date" placeholder="End" required>
            </form>
            <h3>Education</h3>
            <form>
              <input type="text" placeholder="University" required class="input-box">
              <input type="text" placeholder="Position" required class="input-box">
              <input type="date" placeholder="Start" required>
              <input type="date" placeholder="End" required>
            </form>
            <?php
            session_start();
            $dbhost = "sql109.epizy.com";
            $dbuser = "epiz_33784251";
            $dbpass = "XzX7r5XomWU";
            $dbname = "epiz_33784251_cs4116";

            $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

            if (mysqli_connect_errno()) {
              die('Could not connect: ' . mysqli_connect_error());
            }

            if (isset($_POST['submit'])) {
              $company = mysqli_real_escape_string($conn, $_POST['company']);
              $position = mysqli_real_escape_string($conn, $_POST['lastName']);

              $query = "INSERT INTO users (firstName, lastName, email, password) VALUES ('$company', '$', '$', '$')";
              if (mysqli_query($conn, $query)) {
                echo "New record created successfully";
                echo "Login Successful... Redirecting";
                header("Location: profilePage.php");
              } else {
                echo "Error: " . $query . "<br>" . mysqli_error($conn);
              }
            }
            ?>
          </div>
        </div>
        <p class="signUpCompany">Signing up as a company? <a href="signUpCompany.php">Company Sign Up</a></p>
        <p class="login">Already have an account? <a href="login.php">Login Now</a></p>
      </div>

    </div>
  </div>
</body
</html>
