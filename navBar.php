<div class="navbar">
    <link rel="stylesheet" type="text/css" href="Style/menu.css" />
    <div class="navbar-inner">
        <a class="brand" href="#">careerWise</a>
        <ul class="nav">
            <li <?php if ($_SERVER['PHP_SELF'] == "/people.php") echo 'class="active"'; ?>><a href="people.php">People</a></li>
            <li><a href="#">Companies</a></li>
            <li><a href="#">Activity</a></li>
            <li><a href="#">Opportunities</a></li>
            <li <?php if ($_SERVER['PHP_SELF'] == "/profilePage.php" && empty($_SERVER['QUERY_STRING'])) echo 'class="active"'; ?> style="float: right; border-right: none">
                <a href="profilePage.php">You</a>
            <li <?php if ($_SERVER['PHP_SELF'] == "/company_profile.php" && empty($_SERVER['QUERY_STRING'])) echo 'class="active"'; ?> style="float: right; border-right: none">
                <a href="company_profile.php">You</a>
            </li>
        </ul>
    </div>
</div>
