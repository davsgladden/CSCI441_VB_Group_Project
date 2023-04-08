<?php
    session_start();

    include("connection.php");
    include("functions.php");
    include("controller/systemController.php");

    if(isset($_SESSION['user_id'])) {
        $user_data = fetchUser($con, "UserID = $_SESSION[user_id]");
        $portfolio = getPortfolioInfo($con, $user_data->get_ID());
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Ticket</title>
</head>
<style>
    body{margin-left: 100px;}
    p{
        padding: 15px;
        font-size: 20px;
    }

    .submit {
        background-color: #549bf7; /* Aqua */
        border: grey;
        color: black;
        padding: 10px 24px;
        text-align: center;
        text-decoration: none;
        font-size: 12px;
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
    <p>Hello, <?php echo $user_data->get_UserName(); ?>.<br>
        Would you like to make an order?</p>
    <form class = "center" method="post" action="confirmation.php">
        <label for="commodity">Commodity:</label>
        <select id="commodity" name="commodity">
            <option selected="selected">Choose a commodity</option>
            <?php
            // Iterating through the Commodity object array
            foreach(array_filter($portfolio) as $row){
                echo "<option value='$row[CommodityName]'>$row[CommodityName]</option>";
            }
            ?>
        </select><br>
        <label for="amount">Amount:  </label>
        <input type="text" id="amount" name="amount">
        <br>
        <input class="submit" type="submit" name="submit" value="Submit">
    </form>
</body>
</html>