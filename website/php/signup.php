<?php
    session_start();

    include("connection.php");
    include("functions.php");

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        //Something was posted
        $user_name = $_POST['user_name'];
        $password = $_POST['password'];

        if(!empty($user_name) && !empty($password) && !is_numeric($user_name)){
            //Save to database
            $user_id = random_num(19);
            $query = "INSERT INTO users (UserID,UserName,Password,IsActive) VALUES ('$user_id', '$user_name', '$password', 1)";
            mysqli_query($con, $query);

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
            background-color: grey;
            border: none;
            text-align: center;
        }
        .header{
            background-color: #4f97e0;
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
            <div style="font-size: 20px; margin: 10px;">Sign Up</div>
            <label for="user_name">Username:</label>
            <input id="text" type="text" name="user_name"><br><br>
            <label for="password">Password:</label>
            <input id="text" type="password" name="password"><br><br>

            <input id="button" type="submit" value="Sign Up"><br><br>

            <a href="login.php">Click to Login</a><br><br>

        </form>
    </div>

</body>
</html>