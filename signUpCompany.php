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
          <a class="brand" href="index.html" style="border-right: none;">careerWise</a>
        </div>
      </div>
    </div>

    <div id="content">
      <div id="signUpPage">
        <h1>Register a Company Account</h1>
        <form method="POST">
        <div class="signup-box">
          <div class="container-fluid">
            <h3> Basic Details</h3>
              <input type="text" name="company" placeholder="Company Name" required>
              <input type="text" name="contactName" placeholder="Contact Name" required>
              <input type="email" name="email" placeholder="Email" required>
              <input type="password" name="password" placeholder="Create Password" required>
              <input type="password" name="confirmPassword" placeholder="Confirm Password" required>
              <div class="checkbox">
                <input type="checkbox" id="terms" required>
                <label for "terms"> I accept the terms and conditions.</label>
              </div>
              <button class="btn-primary" name="submit" type="submit"> Create! <span> &#x27f6; </span></button>
          </div>
        </div>
        </form>
        <p class="SignUp">Signing up as an individual? <a href="SignUp.php">Click Here</a></p>
        <p class="login">Already have an account? <a href="login.php">Login Now</a></p>
      </div>

    </div>
  </div>
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
    $contactName = mysqli_real_escape_string($conn, $_POST['contactName']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirmPassword = mysqli_real_escape_string($conn, $_POST['confirmPassword']);

    //check if the email already exists in the business database
    $query = "SELECT * FROM business WHERE email = '$email'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
      // The email already exists in the database
      echo "An account with this email already exists";
      exit();
    }

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

    $query = "INSERT INTO business (company, contactName, email, password) VALUES ('$company', '$contactName', '$email', '$password')";
    if (mysqli_query($conn, $query)) {
      session_start();
      $_SESSION['user_id'] = $user_id;
      $_SESSION['user_id']=mysqli_insert_id($conn);
      echo "New record created successfully";
      echo "Login Successful... Redirecting";
      header("Location: profilePage.php");
    } else {
      echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
  }
  ?>
</body>

</html>
