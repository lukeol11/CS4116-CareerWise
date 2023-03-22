<!DOCTYPE html>
<html lang="en">

<head>
  <title>careerWise | Login</title>
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
  <h1>Create an account</h1>
  <div class="signup-box">
    <div class="left-box">
      <h1> Basic Details</h1>
      <form>
        <input type="text" placeholder="Name" required class="input-box">
        <input type="text" placeholder="Username" required class="input-box">
        <input type="email" placeholder="Email" required class="input-box">
        <input type="password" placeholder="Create Password" required class="input-box">
        <div class="checkbox">
          <input type="checkbox" id="terms">
          <label for "terms"> I accept the terms and conditions.</label>
        </div>
        <button class="btn-primary" type="submit"> Create! <span> &#x27f6; </span></button>
      </form>
    </div>
    <div class="right-box">
      <h1> Jobs & Education</h1>
      <form>
        <input type="text" placeholder="Company" required class="input-box">
        <input type="text" placeholder="Position" required class="input-box">
      </form>
    </div>
  </div>
  <p class="login">Already have an account? <a href="index.php"> Login Now</a></p>
</div>

    </div>
  </div>
</body>

</html>