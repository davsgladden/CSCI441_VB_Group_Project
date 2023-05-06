<?php
    session_start();

    include("connection.php");
    include("functions.php");
    include("controller/systemController.php");

    if(isset($_SESSION['user_id'])) {
        $user_data = fetchUser($con, "UserID = $_SESSION[user_id]");
    }

    if($user_data->get_UserTypeID() === '2'){?>
        <style type="text/css">
        #manager{
         display:inline;
         }</style>
    <?php } else {?>
            <style type="text/css">
        #manager{
             display:none;
             }</style>
        <?php }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Account</title>
</head>
<style>
    h2{
        padding: 15px;
        font-family: Verdana, Arial;
    }
    p{
        padding: 15px;
        font-size: 20px;
        font-family: Verdana, Arial;
    }
    table, th, td {
        padding: 15px;
        margin: 15px;
        font-size: 20px;
        width: 45%;
        text-align: center;
        font-family: Verdana, Arial;
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
        font-family: Verdana, Arial;
    }
    .button a {
        color: white;
    }
    .button:hover{
        background-color: #5A5A5A;
    }
    #page{
        display: flex;
        align-items: flex-start;
        flex-direction: row;
        flex-wrap: wrap;
        justify-content: left;
        padding: 15px;
        flex-grow: 1;
    }
    #traineeTable {
        list-style-type: none;
        padding: 15px;
        margin: 15px;
        font-size: 20px;
        width: 200%;
        text-align: center;
        font-family: Verdana, Arial;
        border: 1px solid;
        border-collapse: collapse;
    }

</style>
<body>
    <?php include_once("navbar.php");?>

    <br>
    <h2>Account Page</h2>
    <p>Hello, <?php echo $user_data->get_UserName(); ?>. Your account details are below: </p>
    <div id="page">
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
        <button class="button"><a href="addTrainees.php" target="myManageriFrame">Add Trainees</a></button>
        </form>
        <iframe width="800" height ="315" class="center" name="myManageriFrame" id="myiFrame" ></iframe>

        <form method="update">
                <button class="button"><a href="updatePassword.php" target="myiFrame">Change Password</a></button>
        </form>

    <iframe width="800" height ="315" class="center" name="myiFrame" id="myiFrame" ></iframe>
    <section>
        <h2>Managed Trainees:</h2>
    <ul id="traineeTable">
    <?php
    $traineeData = fetchTraineeManagement($con, "ManagerUserID = $user_data->ID"); //get trainees for manager
    $traineeArr[] = array();
    if(is_array($traineeData)) { //loop to get all trainee users
        foreach (array_filter($traineeData) as $trainee) {
            $id = $trainee->get_TraineeUserID();
            $traineeUser = fetchUser($con, "ID = $id");
            $traineeArr[] = $traineeUser;
        }
    }
    else {
        $id = $traineeData->get_TraineeUserID();
        $traineeArr[] = fetchUser($con, "ID = $id");
    }
    foreach(array_filter($traineeArr) as $traineeRow){
    //print all trainee user names
        echo '<li>' . $traineeRow->get_UserName() . '</li>';
        echo "<br>";
    }
    ?>
    </ul>
</section>
    </div>
</body>
</html>