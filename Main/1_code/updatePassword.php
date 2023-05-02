<?php
 session_start();
 include("connection.php");
 include("functions.php");
 include("controller/systemController.php");

 if($_SERVER['REQUEST_METHOD'] == "POST"){
     //Something was posted
     $password = $_POST['password'];
     $confPass = $_POST['conf_password'];
     $newPass = $_POST['new_password'];

       if($password !== $confPass){
        echo '<p style="color: red; text-align: center;">Passwords do not match!</p>';
       }else{
        $user_data = fetchUser($con, "UserID = $_SESSION[user_id]");
        $user_data->set_password($newPass);
        updateUser($con, $user_data);
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
        background-color: #549bf7; /* Black */
        border: grey;
        color: black;
        padding: 10px 24px;
        text-align: center;
        text-decoration: none;
        font-size: 15px;
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
    <div id="box">
        <form method="post">
            <div style="font-size: 20px; margin: 10px;">Update Password</div>

            <label for="user_name">Current Password:</label>
            <input id="text" type="password" name="password"><br><br>

            <label for="user_name">Confirm Password:</label>
            <input id="text" type="password" name="conf_password"><br><br>

            <label for="password">New Password:</label>
            <input id="text" type="password" name="new_password"><br><br>


            <script>
                function clickAlert() {
                parent.location.reload();
            }
            </script>
            <input onClick="clickAlert();" id="button" type="submit" value="Submit"><br><br>

        </form>
    </div>

</body>
</html>