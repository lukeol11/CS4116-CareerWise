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
        <h1>Create An Account</h1>
        <form method="POST">
          <div class="signup-box">
            <div class="left-box">
              <h1> Basic Details</h1>
              <input type="text" name="firstName" placeholder="First Name" required>
              <input type="text" name="lastName" placeholder="Last Name" required>
              <input type="email" name="email" placeholder="Email" required>
              <input type="password" name="password" placeholder="Create Password" required>
              <input type="password" name="confirmPassword" placeholder="Confirm Password" required>
              <div class="checkbox">
                <input type="checkbox" id="terms" required>
                <label for="terms"> I accept the terms and conditions.</label>
              </div>


            </div>
            <div class="right-box">
              <h1> Jobs & Education</h1>
              <h3>Previous Company</h3>
              <input type="text" name="company" placeholder="Company" required>
              <input type="text" name="position" placeholder="Position" required>
              <input type="date" name="employment_start_date" placeholder="Start" required>
              <input type="date" name="employment_end_date" placeholder="End" required>
              <h3>Education</h3>
              <input type="text" name="school" placeholder="University" required>
              <input type="text" name="course" placeholder="Course" required>
              <input type="date" name="education_start_date" placeholder="Start" required>
              <input type="date" name="education_end_date" placeholder="End" required>
            </div>
          </div>
          <button class="btn-primary" name="submit" type="submit"> Create! <span> &#x27f6; </span></button>
        </form>
        <p class="signUpCompany">Signing up as a company? <a href="signUpCompany.php">Company Sign Up</a></p>
        <p class="login">Already have an account? <a href="login.php">Login Now</a></p>
      </div>

    </div>
  </div>
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
    //information for user
    $firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
    $lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirmPassword = mysqli_real_escape_string($conn, $_POST['confirmPassword']);
    //information for employment_history
    $company = mysqli_real_escape_string($conn, $_POST['company']);
    $position = mysqli_real_escape_string($conn, $_POST['position']);
    $employment_start_date = mysqli_real_escape_string($conn, $_POST['employment_start_date']);
    $employment_end_date = mysqli_real_escape_string($conn, $_POST['employment_end_date']);
    //information for education_history
    $school = mysqli_real_escape_string($conn, $_POST['school']);
    $course = mysqli_real_escape_string($conn, $_POST['course']);
    $education_start_date = mysqli_real_escape_string($conn, $_POST['education_start_date']);
    $education_end_date = mysqli_real_escape_string($conn, $_POST['education_end_date']);

    //check if the email exists in the users database
    $query = "SELECT * FROM users WHERE email = '$email'";
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

    // Start transaction
    mysqli_begin_transaction($conn);

    // Insert into users table
    $query1 = "INSERT INTO users (firstName, lastName, email, company, password) VALUES ('$firstName', '$lastName', '$email', '$company', '$password')";
    if (!mysqli_query($conn, $query1)) {
      echo "Error: " . $query1 . "<br>" . mysqli_error($conn);
      mysqli_rollback($conn);
      exit();
    }

    // Insert into employment_history table
    $query2 = "INSERT INTO employment_history (company, position, start_date, end_date) VALUES ('$company', '$position', '$employment_start_date', '$employment_end_date')";
    if (!mysqli_query($conn, $query2)) {
      echo "Error: " . $query2 . "<br>" . mysqli_error($conn);
      mysqli_rollback($conn);
      exit();
    }

    // Insert into education_history table
    $query3 = "INSERT INTO education_history (school, course, start_date, end_date) VALUES ('$school', '$course', '$education_start_date', '$education_end_date')";
    if (!mysqli_query($conn, $query3)) {
      echo "Error: " . $query3 . "<br>" . mysqli_error($conn);
      mysqli_rollback($conn);
      exit();
    }

    // Commit transaction
    mysqli_commit($conn);

    echo "New record created successfully";

    header("Location: login.php");
  }
  ?>
</body>

</html>