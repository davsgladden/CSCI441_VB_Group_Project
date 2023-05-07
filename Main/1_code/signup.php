<?php
    session_start();

    include("connection.php");
    include("functions.php");
    include("controller/systemController.php");

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        //Something was posted
        $user_name = $_POST['user_name'];
        $password = $_POST['password'];
        $user_type = $_POST['UserTypeID'];

        if(!empty($user_name) && !empty($password) && !is_numeric($user_name)){
            //Save to database
            $user_id = random_num(19);

            $newUser = new Users();
            $newUser->set_userID($user_id);
            $newUser->set_userName($user_name);
            $newUser->set_password($password);
            $newUser->set_AvailableFunds(10000);
            $newUser->set_IsActive(1);
            $newUser->set_UserTypeID($user_type);/**  updated to now change depending on how the user signed up for the site */
            insertUser($con, $newUser);

            header("Location: login.php");
            die;
        }else{
            echo '<p style="color: red; text-align: center;">Please enter valid information!</p>';
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
</head>
<body>
    <style type="text/css">
        #text{
            height: 25px;
            border-radius: 5px;
            padding: 4px;
            border: solid thin #aaa;
            text-align: center;
            width: 65%;
        }

        #button{
            padding: 10px;
            width: 100px;
            color: white;
            background-color: #549bf7;
            border: none;
            text-align: center;
            font-family: Verdana, Arial;
            font-size: 15px;
        }
        .header{
            background-color: #549bf7;
            margin: auto;
            width: 500px;
            height: 50px;
            padding: 20px;
            text-align: center;
            color: gold;
            font-family: Verdana, Arial;
        }
        #box{
            background-color: white;
            margin: auto;
            width: 500px;
            padding: 20px;
            text-align: center;
            border: solid thin #aaa;
        }
    </style>
    <div class="header">
        <h1>AgriCom Training</h1>
    </div>
    <div id="box">
        <form method="post">
            <div style="font-size: 20px; margin: 10px;">Create User Login</div>
            <label for="user_name">Create Username:</label>
            <input id="text" type="text" name="user_name"><br><br>
            <label for="password">Create Password:</label>
            <input id="text" type="password" name="password"><br><br>
            <input type="radio" id="usertype" name ="UserTypeID" value="1">
            <label for="UserTypeID">Trainee</label>
            <input type="radio" id="usertype" name ="UserTypeID" value="2">
            <label for="UserTypeID">Manager</label><br><br>

            <input id="button" type="submit" value="Sign Up"><br><br>

            <a href="login.php">Click to Login</a><br><br>

        </form>
    </div>

</body>
</html>