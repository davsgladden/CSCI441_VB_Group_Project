<?php
    session_start();

    include("connection.php");
    include("functions.php");
    include("controller/systemController.php");

    if(isset($_SESSION['user_id'])) {
        $user_data = fetchUser($con, "UserID = $_SESSION[user_id]");
        $traineeArr = fetchUser($con, "userTypeID=1");
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Trainee List</title>
</head>
<style>
    body{margin-left: 100px;}
    p{
        padding: 1pxpx;
        font-size: 20px;
    }

    .submit {
        background-color: #549bf7; /* Aqua */
        border: grey;
        color: white;
        padding: 10px 24px;
        text-align: center;
        text-decoration: none;
        font-size: 18px;
        cursor: pointer !important;
    }
    .submit:hover {
        background-color: #5A5A5A;
    }


    select {
        width: 75%;
        min-width: 15ch;
        max-width: 25ch;
        border-radius: 0.25em;
        padding: 0.25em 0.5em;
        font-size: 1.25rem;
        cursor: pointer;
        line-height: 1.1;
        border: 1px solid grey;
        margin: 0px;
    }
    input{
        min-width: 15ch;
        max-width: 30ch;
        border-radius: 0.25em;
        padding: 0.25em 0.5em;
        font-size: 1.25rem;
        line-height: 1.1;
        border: 1px solid grey;
    }
    form{
        font-size: 18px;
        max-width: 100%;
        border-radius: 0.25em;
        padding: 0.25em 0.5em;
        font-size: 1.25rem;
    }
</style>
<body>
    <p>Please select trainee from list below to manage them in the future.</p>
    <form class = "center" method="post" action="newTraineeAdded.php">
        Select a trainee:<br>
        <label for="trainee">Trainee:</label>
        <select id="trainee" name="trainee">
            <option selected="selected">Choose a trainee</option>
            <?php
            // Iterating through the trainee object array
            foreach(array_filter($traineeArr) as $user){
                echo "<option value='$user->ID'>$user->UserName</option>";
            }
            ?>
        </select>
        <br><br>

        <input class="submit" type="submit" name="submit" value="Add Trainee">
        <?php $addTrainee = new TraineeManagement();
            $addTrainee->set_ManagerUserID($user_data->get_ID());
            $addTrainee->set_isActive(1);?>
        <input type='hidden' name="addTrainee" id="addTrainee" value='<?php echo json_encode($addTrainee); ?>'>
    </form>
</body>
</html>