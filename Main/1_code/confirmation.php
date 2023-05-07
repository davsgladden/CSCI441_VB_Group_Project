<?php
    session_start();

    include("connection.php");
    include("functions.php");
    include("controller/systemController.php");

    if(isset($_SESSION['user_id'])) {
        $user_data = fetchUser($con, "UserID = $_SESSION[user_id]");
        $portfolio = getPortfolioInfo($con, $user_data->get_ID());
    }

    $commodity = new Commodity();
    if (isset($_POST['commodity'])) {
        $commodity = fetchCommodity($con, "CommodityName = '$_POST[commodity]'");
    }
    $Amount = null;
    if (isset($_POST['amount'])) {
        $Amount = $_POST['amount'];
    }
    $orderType = null;
    if (isset($_POST['orderType'])) {
        $orderType = $_POST['orderType'];
    }
    //update commodity price before order
    updateCommodityPrice($con, $commodity->get_Symbol());

    $Price = $commodity->get_CurrentPrice();
    $Total = $Price*$Amount;

    date_default_timezone_set('America/Chicago'); //Central timezone
    $Transaction = new TransactionHistory();
    $Transaction->set_UserID($user_data->get_ID());
    $Transaction->set_CommodityID($commodity->get_CommodityID());
    $Transaction->set_Amount($Amount);
    $Transaction->set_Price($Price);
    $Transaction->set_TransactionPrice($Total);
    $Transaction->set_OrderType($orderType);
    $Transaction->set_TransactionDate(date('Y-m-d H:i:s'));

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
        //parent.location.reload();
        alert("Order received!");
    }
</script>
<body>
    <p>Are you sure you want to make this order?</p>
    <form class = "center" action ="submitOrder.php" method="post">
        You are about to submit a <?php echo $orderType; ?> order for the following:<br>
        Commodity: <?php echo $commodity->get_CommodityName(); ?><br>
        Amount: <?php echo $Amount; ?><br>
        Total Transaction: $<?php echo $Total; ?><br>
        Total Funds in account: $<?php echo $user_data->get_AvailableFunds(); ?><br><br>
        Click 'Back' to update your order or click 'Submit' to confirm the <?php echo $orderType; ?> order.

        <br>
        <input class="submit" type="submit" name="back" value="Back" onClick="submit">
        <input class="submit" type="submit" id="submitOrder" name="submitOrder" value="Submit" onClick="clickAlert();">
        <input type='hidden' name='var' value='<?php echo json_encode($Transaction); ?>'>
    </form>
</body>
</html>