<?php
    session_start();

    include("connection.php");
    include("functions.php");
    include("controller/systemController.php");

    if(isset($_SESSION['user_id'])) {
        $user_data = fetchUser($con, "UserID = $_SESSION[user_id]");
        $portfolio = getPortfolioInfo($con, $user_data->get_ID());
    }

    updateAllPrices($con,$endpoint,$access_key);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
</head>
<style>
    p{
        padding: 15px;
        font-size: 20px;
    }

    table {
      font-family: arial, sans-serif;
      border-collapse: collapse;
      width: 65%;
    }

    td, th {
      border: 1px solid #dddddd;
      text-align: left;
      padding: 8px;
    }

    tr:nth-child(even) {
      background-color: #dddddd;
    }
    .center {
      margin-left: auto;
      margin-right: auto;
    }

</style>
<script>
    const closeIFrame = function() {
        $('#myiFrame').remove();
    }
</script>
<body>
    <?php include_once("navbar.php");?>

    <br>
    <p>Hello, <?php echo $user_data->get_UserName(); ?></p>
    <p>Current portfolio infomation for your account is:</p>
        <!--todo: displayed for testing. Revisit for actual display -->
       <div>
        <table class="center">
        <?php
        echo '<th>Symbol</th>
              <th>CommodityName</th>
              <th>Amount</th>
              <th>Purchase Avg</th>
              <th>Current Price</th>
              <th>TotalValue</th>';
        if ($portfolio > 1)
        foreach($portfolio as $rows){
            echo '
            <tr>
                <td>'.$rows['Symbol'].'</td>
                <td>'.$rows['CommodityName'].'</td>
                <td>'.$rows['Amount'].'</td>
                <td>'.$rows['PurchaseAvg'].'</td>
                <td>'.$rows['CurrentPrice'].'</td>
                <td>'.$rows['TotalValue'].'</td>
            </tr>
            ';
        }
        ?>
        </table>
            <p>
            <?php $total = getAccountTotal($con, $portfolio, $user_data->get_AvailableFunds());
                echo "Available funds in your account: $", number_format($user_data->get_AvailableFunds(),2);
                echo '<br>';
                echo "Total value in account is: $",  number_format($total, 2);
                ?>
            </p>
        </div>
</body>
</html>