<?php
    session_start();

    include("connection.php");
    include("functions.php");
    include("controller/systemController.php");

    $id = "";
    if(isset($_SESSION['user_id'])) {
        $user_data = fetchUser($con, "UserID = $_SESSION[user_id]");
        if($user_data->get_UserTypeID() == 1) {
            $portfolio = getPortfolioInfo($con, $user_data->get_ID());;
        } else if($user_data->get_UserTypeID() == 2)
            $id = getTraineeIds($con, $user_data->get_ID());
    }

    //updateAllPrices($con,$endpoint,$access_key);

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
        font-family: Verdana, Arial;
    }
    h2{
        padding: 15px;
        font-family: Verdana, Arial;
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
      font-family: Verdana, Arial;
    }

    tr:nth-child(even) {
      background-color: #dddddd;
    }
    .center {
      margin-left: auto;
      margin-right: auto;
    }
    hr {
        border: 0;
        clear:both;
        display:block;
        width: 96%;
        background-color:#549bf7;
        height: 3px;
    }
</style>
<body>
    <?php include_once("navbar.php");?>
    <br>
    <h2>Portfolio Page</h2>
    <!--Display for trainee users-->
    <?php if($user_data->get_UserTypeID() == 1) { ?>
        <p><b>Current portfolio information for your account is:</b></p>
       <div>
        <table class="center">
        <?php
        echo '<th>Symbol</th>
              <th>Commodity Name</th>
              <th>Amount</th>
              <th>Purchase Avg</th>
              <th>Current Price</th>
              <th>Total Value</th>';
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
                echo "&emsp;Available funds in your account: $", number_format($user_data->get_AvailableFunds(),2);
                echo '<br>';
                echo "&emsp;Total value in account is: <b>$",  number_format($total, 2),"</b>";
                ?>
            </p>
        </div>
    <?php } ?>
    <!--Display for manager users-->
    <?php if($user_data->get_UserTypeID() == 2) {
            if($id == 0) {
                echo '<p>You are not currently managing any trainee accounts.<br>
                        Please use the Account page to select trainee accounts to manage.</p>';
            } else {?>
        <p><b>Current portfolio information for your managed trainee accounts:</b></p>
        <hr>
        <div>
            <?php
            $id = preg_replace('/\.$/', '', $id);
            $idArray = explode(',', $id);
            foreach($idArray as $traineeId)
            {
                $portfolio = getPortfolioInfo($con, $traineeId); ?>
            <table class="center">
                <?php $traineeUser = fetchUser($con, "ID = $traineeId");
                echo '<p><b>&emsp;Portfolio Information for Trainee '. $traineeUser->get_UserName().'</b></p>';
                if ($portfolio!==null) {
                echo '<th>Symbol</th>
                <th>Commodity Name</th>
                <th>Amount</th>
                <th>Purchase Avg</th>
                <th>Current Price</th>
                <th>Total Value</th>';
                    foreach ($portfolio as $rows) {
                        echo '
            <tr>
                <td>' . $rows['Symbol'] . '</td>
                <td>' . $rows['CommodityName'] . '</td>
                <td>' . $rows['Amount'] . '</td>
                <td>' . $rows['PurchaseAvg'] . '</td>
                <td>' . $rows['CurrentPrice'] . '</td>
                <td>' . $rows['TotalValue'] . '</td>
            </tr>
            ';
                    }
                } else
                    echo '<p>&emsp;&emsp;&emsp;Portfolio is currently empty for trainee '.$traineeUser->get_UserName().'</p>';
                ?>
            </table>
            <p>
                <?php $total = getAccountTotal($con, $portfolio, $traineeUser->get_AvailableFunds());
                echo "&emsp;Available funds in trainee account: $", number_format($traineeUser->get_AvailableFunds(),2);
                echo '<br>';
                echo "&emsp;Total value in trainee account is: <b>$",  number_format($total, 2),"</b>";
                ?>
            </p> <hr>
        </div>
    <?php }} ?>
    <?php } ?>
</body>
</html>