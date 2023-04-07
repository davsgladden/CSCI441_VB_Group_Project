<?php
    session_start();

    include("connection.php");
    include("functions.php");
    include("controller/systemController.php");

    if(isset($_SESSION['user_id'])) {
        $user_data = fetchUser($con, "UserID = $_SESSION[user_id]");
        $portfolio = getPortfolioInfo($con, $user_data->get_ID());
    }
    $Commodity = null;
    if (isset($_POST['commodity'])) {
        $Commodity = $_POST['commodity'];
    }
    $Amount = null;
    if (isset($_POST['amount'])) {
        $Amount = $_POST['amount'];
    }
    $Price = 1000;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Confirmation</title>
</head>
<style>
    p{
        padding: 15px;
        font-size: 20px;
    }

    form{
        font-size: 18px;
        max-width: 100%;
        border-radius: 0.25em;
        padding: 0.25em 0.5em;
        font-size: 1.25rem;
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

</style>
<script>
    function clickAlert() {
        parent.location.reload();
        alert("Order received!");
    }
</script>
<body>
    <p>Are you sure you want to make this order?</p>
    <form class = "center" action ="ticket.php">
        You are about to submit a sell order for the following:<br>
        Commodity: <?php echo $Commodity; ?><br>
        Amount: <?php echo $Amount; ?><br>
        Total Price: <?php echo $Price; ?><br><br>
        Click 'Back' to update your order or click 'Submit' to confirm the sell order.

        <br>
        <input class="submit type="submit" name="back" value="Back" onClick="submit">
        <input class="submit type="submit" name="submit" value="Submit" onClick="clickAlert();">
    </form>
</body>
</html>