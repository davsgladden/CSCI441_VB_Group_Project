<?php
    session_start();
    include("connection.php");
    include("controller/systemController.php");

/**
 * @param $con
 * @return array
 * @throws Exception
 */
function createOrderTest($con, $orderType): array
{
    $user_data = fetchUser($con, "ID = '2'");
    $Commodity = fetchCommodity($con, "CommodityID = 3");
    $portfolio = fetchPortfolio($con, "UserID = $user_data->ID and CommodityID = $Commodity->CommodityID");
    $Amount = 1;
    $Price = $Commodity->get_CurrentPrice();
    $Total = $Amount * $Price;
    date_default_timezone_set('America/Chicago'); //Central timezone
    $Transaction = new TransactionHistory();
    $Transaction->set_UserID($user_data->get_ID());
    $Transaction->set_CommodityID($Commodity->get_CommodityID());
    $Transaction->set_Amount($Amount);
    $Transaction->set_Price($Price);
    $Transaction->set_OrderType($orderType);
    $Transaction->set_TransactionPrice($Total);
    $Transaction->set_TransactionDate(date('Y-m-d H:i:s'));
    return array($user_data, $Commodity, $portfolio, $Amount, $Price, $Total, $Transaction);
}

    /** sell order test */
    list($user_data, $Commodity, $portfolio, $Amount, $Price, $Total, $Transaction) = createOrderTest($con, 'Sell');

    echo "Testing SELL functionality for User ID $user_data->ID and Commodity $Commodity->CommodityName.<br>";
    echo "Current portfolio information for this user and commodity is: <br>";
    echo json_encode($portfolio);
    echo "<br>";

    echo "Transaction information is: <br>";
        var_dump($Transaction);
        echo "<br>";
        try {
            if ($Transaction->get_OrderType() == 'Buy') {
                purchaseOrder($con, $Transaction);
            } else if ($Transaction->get_OrderType() == 'Sell') {
                sellOrder($con, $Transaction);
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    $portfolioAfter = fetchPortfolio($con, "UserID = $user_data->ID and CommodityID = $Commodity->CommodityID");
    echo "Post test portfolio information for this user and commodity is: <br>";
    echo json_encode($portfolioAfter);
    echo "<br><br><br>";

    /** Buy order test **/
    list($user_data, $Commodity, $portfolio, $Amount, $Price, $Total, $Transaction) = createOrderTest($con, 'Buy');

    echo "Testing BUY functionality for User ID $user_data->ID and Commodity $Commodity->CommodityName.<br>";
    echo "Current portfolio information for this user and commodity is: <br>";
    echo json_encode($portfolio);
    echo "<br>";

    echo "Transaction information is: <br>";
    var_dump($Transaction);
    echo "<br>";
    try {
        if ($Transaction->get_OrderType() == 'Buy') {
            purchaseOrder($con, $Transaction);
        } else if ($Transaction->get_OrderType() == 'Sell') {
            sellOrder($con, $Transaction);
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    $portfolioAfter = fetchPortfolio($con, "UserID = $user_data->ID and CommodityID = $Commodity->CommodityID");
    echo "Post test portfolio information for this user and commodity is: <br>";
    echo json_encode($portfolioAfter);
    echo "<br>";