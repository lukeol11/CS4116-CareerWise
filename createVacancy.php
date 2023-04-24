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
          <div class="form-group">
            <label for="company">Company</label>
            <input type="text" class="form-control" id="company" name="company" required>
          </div>
          <div class="form-group">
            <label for="position">Position</label>
            <input type="text" class="form-control" id="position" name="position" required>
          </div>
          <div class="form-group">
            <label for="salary_range">Salary Range</label>
            <input type="text" class="form-control" id="salary_range" name="salary_range" required>
          </div>
          <button class="btn btn-primary" name="submit" type="submit">Submit</button>
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
          $company = mysqli_real_escape_string($conn, $_POST['company']);
          $position = mysqli_real_escape_string($conn, $_POST['position']);
          $salary_range = mysqli_real_escape_string($conn, $_POST['salary_range']);

          // Retrieve the company_id from the business table based on the provided company name
          $sql = "SELECT company_id FROM business WHERE company = '$company'";
          $result = mysqli_query($conn, $sql);

          if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $company_id = $row['company_id'];

            session_start();
            $userId = $_SESSION['user_id'];

            // Insert the new record into the vacancies table using the retrieved company_id
            $sql = "INSERT INTO vacancies (company_id, position, salary_range) VALUES ('$company_id', '$position', '$salary_range')";
            $result = mysqli_query($conn, $sql);

            if ($result) {
              echo "Post Made successfully!";
              echo "Return to <a href='opportunities.php'>Opportunities</a>";
            } else {
              echo "Error: " . mysqli_error($conn) . " (" . mysqli_errno($conn) . ")";
            }
          } else {
            echo "Error: Company not found";
          }

          mysqli_close($conn);
        }
        ?>
      </div>
    </div>
  </div>

</body>

</html>