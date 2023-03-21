<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Template</title>
    <link rel="stylesheet" type="text/css" href="Style/content.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=K2D:wght@100&display=swap"
      rel="stylesheet"
    />
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen" />
  </head>
  <body>
    <div id="main">
      <script src="https://code.jquery.com/jquery.js"></script>
      <script src="js/bootstrap.min.js"></script>

      <div id="menu">
        <?php include 'navBar.php';?>
      </div>
      
      <div id="content">
        <?php include 'profilePage.php';?>
      </div>
    </div>
  </body>
</html>
