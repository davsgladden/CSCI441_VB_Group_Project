<?php
    session_start();

    include("connection.php");
    include("functions.php");
    include("controller/systemController.php");

    $user_data = check_login($con);
    $port = fetchPortfolio($con, 2);
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
</style>
<body>
    <?php include_once("navbar.php");?>

    <br>
    <p>Hello, <?php echo $user_data['UserName']; ?></p>

        <table>
        <?php
        echo '<th>CommodityID</th>
              <th>Amount</th>';
        foreach($port as $portfolio){
            echo '
            <tr>
                <td>'.$portfolio['CommodityID'].'</td>
                <td>'.$portfolio['Amount'].'</td>
            </tr>
            ';
        }
        ?>
        </table>
</body>
</html>