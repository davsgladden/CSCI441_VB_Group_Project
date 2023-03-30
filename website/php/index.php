<?php
    session_start();

    include("connection.php");
    include("functions.php");
    include("controller/systemController.php");

    $user_data = check_login($con);
    $test = fetchCommodity($con,"");
    $port = fetchPortfolio($con, 2);
    $tot = aggAcctTotal($port);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
</head>
<body>
    <a href="logout.php">Logout</a>
    <a href="portfolio.php">Portfolio</a>
    <h1>This is the home page</h1>

    <br>
    Hello, <?php echo $user_data['UserName']; ?>



</body>
</html>