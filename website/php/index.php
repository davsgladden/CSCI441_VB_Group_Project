<?php
    session_start();

    include("connection.php");
    include("functions.php");

    $user_data = check_login($con);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
</head>
<body>
    <a href="logout.php">Logout</a>
    <h1>This is the home page</h1>

    <br>
    Hello, <?php echo $user_data['UserName']; ?>
</body>
</html>