<?php
 session_start();
 include("connection.php");
 include("functions.php");
 include("controller/systemController.php");

 if($_SERVER['REQUEST_METHOD'] == "POST"){
     //Something was posted
     $user_name = $_POST['user_name'];
     $password = $_POST['password'];

        if(!empty($user_name) && !empty($password) && !is_numeric($user_name)){
            //Read from database
    
            $user = fetchUser($con, "UserName = '$user_name' and Password = '$password'");
            if($user){
                    if($user->get_Password() === $password) {
                        $_SESSION['user_id'] = $user->get_UserID();
                        $user->set_LastLogin(date("Y-m-d H:m:s"));
                        updateUser($con, $user);

                        header("Location: index.php");
                        die;
                    }
                }

            echo '<p style="color: red; text-align: center;">Wrong username or password!</p>';
        }else{
            echo '<p style="color: red; text-align: center;">Wrong username or password!</p>';
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
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
            background-color: grey;
            border: none;
            text-align: center;
        }
        .header{
            background-color: #549bf7;
            margin: auto;
            width: 500px;
            height: 50px;
            padding: 20px;
            text-align: center;
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
            <div style="font-size: 20px; margin: 10px;">Login</div>

            <label for="user_name">Username:</label>
            <input id="text" type="text" name="user_name"><br><br>

            <label for="password">Password:</label>
            <input id="text" type="password" name="password"><br><br>

            <input id="button" type="submit" value="Login"><br><br>

            <a href="signup.php">Click to Sign Up</a><br><br>

        </form>
    </div>

</body>
</html>