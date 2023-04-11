<?php
    session_start();

    include("connection.php");
    include("functions.php");
    include("controller/systemController.php");

    if(isset($_SESSION['user_id'])) {
        $user_data = fetchUser($con, "UserID = $_SESSION[user_id]");
    }


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
    <p>Hello, <?php echo $user_data->get_UserName(); ?>.<br>
        This is the newsfeed page.</p>
</body>
</html>