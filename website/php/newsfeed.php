<?php
    session_start();

    include("connection.php");
    include("functions.php");
    include("controller/systemController.php");

    $user_data = check_login($con);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Newsfeed</title>
</head>
<style>
    p{
        padding: 15px;
        font-size: 20px;
    }
</style>
<body>
    <?php include_once("navbar.php");?>

    <br>
    <p>Hello, <?php echo $user_data['UserName']; ?>.<br>
        This is the newsfeed page.</p>
</body>
</html>