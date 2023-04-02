<!DOCTYPE html>
<html lang="en">

<head>
  <title>careerWise | Login</title>
  <link rel="stylesheet" type="text/css" href="Style/menu.css" />
  <link rel="stylesheet" type="text/css" href="Style/content.css" />
  <link rel="stylesheet" type="text/css" href="Style/login.css">
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
              

              <?php
              if (userLoggedIn){
                redirect profilepage.php
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
