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
    p{
        padding: 15px;
        font-size: 20px;
    }
</style>
<body>
    <p>Hello, <?php echo $user_data->get_UserName(); ?>.<br>
        This is the ticket page.</p>
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
        <label for="amount">Amount:</label>
        <input type="text" id="amount" name="amount">
        <br>
        <input type="submit" name="submit" value="Submit">
    </form>
</body>
</html>