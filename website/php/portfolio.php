<?php
    session_start();

    include("connection.php");
    include("functions.php");
    include("controller/systemController.php");

    $user_data = check_login($con);
    $test = fetchCommodity($con,"");
    $port = fetchPortfolio($con, 2);
    $tot = aggAcctTotal($port);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
</head>
<body>
    <a href="logout.php">Logout</a>
    <a href="index.php">Home</a>
    <h1>This is the portfolio page</h1>

    <br>
    Hello, <?php echo $user_data['UserName'], '<br>',
            "Here is your current portfolio."; ?>
     <?php
     //echo json_encode($test, JSON_PRETTY_PRINT);
     echo "Commodity symbols:", '<br>';
     foreach($test as $result) {
         echo $result['Symbol'], '<br>';
     }
     foreach($port as $portfolio){
         echo 'CommodityID: ', $portfolio['CommodityID'], '<br>';
         echo 'Amount: ',$portfolio['Amount'], '<br>';
         } ?>
    <table>
    <?php
    foreach($port as $portfolio){
        echo '
        <th>CommodityID</th>
        <tr>
            <td>'.$portfolio['CommodityID'].'</td>
            <td>'.$portfolio['Amount'].'</td>
        </tr>
        ';
    }
    ?>
    </table>
    <?php
    $str = "<table>";

    echo '<br>',json_encode($port, JSON_PRETTY_PRINT), '<br>';
    echo "Aggregated total shares: ", json_encode($tot, JSON_PRETTY_PRINT);
     ?>

</body>
</html>