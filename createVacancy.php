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
      <div class="navbar">
        <div class="navbar-inner">
          <a class="brand" href="index.html" style="border-right: none;">careerWise</a>
        </div>
      </div>
    </div>

    <div id="content">
      <div id="signUpPage">
       <h1>Job Vacancy</h1>
       <form method="POST">
              <input type="text" name="company" placeholder="Company" required>
              <input type="text" name="position" placeholder="Position" required>
              <input type="text" name="salary_range" placeholder="salary_range" required>
        <button class="btn-primary" name="submit" type="submit"> Submit</button>
        </form>
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
    $company = mysqli_real_escape_string($conn, $_POST['company']);
    $position = mysqli_real_escape_string($conn, $_POST['position']);
    $salary_range = mysqli_real_escape_string($conn, $_POST['salary_range']);

    // //check if the salary_range exists in the users database
    // $query = "SELECT * FROM users WHERE salary_range = '$salary_range'";
    // $result = mysqli_query($conn, $query);
    // if (mysqli_num_rows($result) > 0) {
    //   // The salary_range already exists in the database
    //   echo "An account with this salary_range already exists";
    //   exit();
    // }

    // // Check if passwords match
    // if ($password != $confirmPassword) {
    //   echo "Error: Passwords do not match";
    //   exit();
    // }

    // // Check password length
    // if (strlen($password) < 8) {
    //   echo "Error: Password must be at least 8 characters long";
    //   exit();
    // }

    // Start transaction
    mysqli_begin_transaction($conn);

    // Insert into users table
    $query1 = "INSERT INTO vacancies (position, salary_range) VALUES ('$position', '$salary_range')";
    if (!mysqli_query($conn, $query1)) {
      echo "Error: " . $query1 . "<br>" . mysqli_error($conn);
      mysqli_rollback($conn);
      exit();
    }

    // Insert into employment_history table
    $query2 = "INSERT INTO business (company) VALUES ('$company')";
    if (!mysqli_query($conn, $query2)) {
      echo "Error: " . $query2 . "<br>" . mysqli_error($conn);
      mysqli_rollback($conn);
      exit();
    }

    // Commit transaction
    mysqli_commit($conn);

    // session_start();
    // $_SESSION['user_id'] = $user_id;
    // $_SESSION['user_id']=mysqli_insert_id($conn);
    // echo "New record created successfully";
    // echo "Login Successful... Redirecting";
    // header("Location: profilePage.php");
  }
  ?>
</body
</html>
