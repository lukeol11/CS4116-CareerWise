<div class="navbar">
  <link rel="stylesheet" type="text/css" href="Style/menu.css" />
  <div class="navbar-inner">
    <a class="brand" href="#">careerWise</a>
    <form action="/search.php" method="GET" class="navbar-form pull-right" style="margin:2em">
      <input type="text" name="query" class="search-query" placeholder="Search...">
    </form>
    <ul class="nav">
      <li <?php if ($_SERVER['PHP_SELF'] == "/people.php") echo 'class="active"'; ?>><a href="people.php">People</a></li>
      <li <?php if ($_SERVER['PHP_SELF'] == "/companies.php") echo 'class="active"'; ?>><a href="companies.php">Companies</a></li>
      <li <?php if ($_SERVER['PHP_SELF'] == "/activity.php") echo 'class="active"'; ?>><a href="activity.php">Activity</a></li>
      <li <?php if ($_SERVER['PHP_SELF'] == "/opportunities.php") echo 'class="active"'; ?>><a href="opportunities.php">Opportunities</a></li>
      <li <?php if ($_SERVER['PHP_SELF'] == "/createVacancy.php") echo 'class="active"'; ?>><a href="createVacancy.php">Create Vacancy</a></li>
      <li style="float: right;">
        <a href="login.php">Log Out</a>
      </li>
      <li <?php if ($_SERVER['PHP_SELF'] == "/profilePage.php" && empty($_SERVER['QUERY_STRING'])) echo 'class="active"'; ?> style="float: right">
        <?php
        session_start();
        if (isset($_SESSION['user_id']) && !isset($_SESSION['company_id'])) {
          echo '<a href="profilePage.php">You</a>';
        } elseif (isset($_SESSION['company_id']) && !isset($_SESSION['user_id'])) {
          echo '<a href="companyPage.php">You</a>';
        } else {
          session_unset();
          echo '<a href="login.php">You</a>';
        }
        ?>
      </li>
    </ul>
  </div>
</div>