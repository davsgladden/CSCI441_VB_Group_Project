<?php
    session_start();

    include("connection.php");
    include("functions.php");
    include("controller/systemController.php");

    $user_data = check_login($con);
    $id = $user_data['ID'];
    $portfolio = getPortfolioInfo($con, $id);

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
<body>
    <?php include_once("navbar.php");?>

    <br>
    <p>Hello, <?php echo $user_data['UserName']; ?></p>
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
            <?php $total = getAccountTotal($con, $portfolio, $id);
                echo "Available funds in your account: $", number_format($user_data['AvailableFunds'],2);
                echo '<br>';
                echo "Total value in account is: $",  number_format($total, 2); ?>
            </p>
        </div>
</body>
</html>