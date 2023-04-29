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
    <title>Account</title>
</head>
<style>
    h2{
        padding: 15px;
    }
    p{
        padding: 15px;
        font-size: 20px;
    }
    table, th, td {
        padding: 15px;
        margin: 15px;
        font-size: 20px;
        width: 35%;
        text-align: center;
    }
    table{
        border: 1px solid;
        border-collapse: collapse;
    }
    .button{
        background-color: #549bf7; /* Black */
        border: grey;
        color: black;
        padding: 10px 24px;
        text-align: center;
        text-decoration: none;
        font-size: 18px;
        margin-left: 15px;
    }
</style>
<body>
    <?php include_once("navbar.php");?>

    <br>
    <h2>Account Page</h2>
    <p>Hello, <?php echo $user_data->get_UserName(); ?>. Your account details are below: </p>
    <table>
        <tr>
            <td>Username:   </td>
            <td><?php echo $user_data->get_UserName(); ?></td>
        </tr>
        <tr>
            <td>Password:   </td>
            <td><?php echo $user_data->get_Password(); ?></td>
        </tr>

    </table>
        <form method="update">
                <button class="button"><a href="updatePassword.php" target="myiFrame">Change Password</a></button>
        </form>

    <iframe width="700" height ="315" class="center" name="myiFrame" id="myiFrame" ></iframe>
</body>
</html>