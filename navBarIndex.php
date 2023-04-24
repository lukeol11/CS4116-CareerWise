<div class="navbarindex">
    <link rel="stylesheet" type="text/css" href="Style/menu.css" />
    <div class="navbar-inner">
        <a class="brand" href="#">careerWise</a>
        <ul class="nav">
            <li <?php if ($_SERVER['PHP_SELF'] == "/index.php" && empty($_SERVER['QUERY_STRING'])) echo 'class="active"'; ?> style="float: right; border-right: none">
                <a href="login.php">Login</a>
            <li <?php if ($_SERVER['PHP_SELF'] == "/index.php" && empty($_SERVER['QUERY_STRING'])) echo 'class="active"'; ?> style="float: right; border-right: none">
                <a href="SignUp.php">Register</a>
            </li>
        </ul>
    </div>
</div>
