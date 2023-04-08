<?php
    session_start();
    include("connection.php");
    include("controller/systemController.php");

    $test = 'buy';

/**
 * @param $con
 * @return array
 * @throws Exception
 */
function createOrderTest($con): array
{
    $user_data = fetchUser($con, "ID = '2'");
    $Commodity = fetchCommodity($con, "CommodityID = 5");
    $Amount = 5;
    $Price = $Commodity->get_CurrentPrice();
    $Total = $Amount * $Price;
    date_default_timezone_set('America/Chicago'); //Central timezone
    $Transaction = new TransactionHistory();
    $Transaction->set_UserID($user_data->get_ID());
    $Transaction->set_CommodityID($Commodity->get_CommodityID());
    $Transaction->set_Amount($Amount);
    $Transaction->set_Price($Price);
    $Transaction->set_TransactionPrice($Total);
    $Transaction->set_TransactionDate(date('Y-m-d H:i:s'));
    return array($user_data, $Commodity, $Amount, $Price, $Total, $Transaction);
}

    list($user_data, $Commodity, $Amount, $Price, $Total, $Transaction) = createOrderTest($con);
    if ($test == 'sell') {
        /** sell order test */
        $Transaction->set_OrderType('Sell');
    }
    if ($test == 'buy') {
        /** purchase order test */
        $Transaction->set_OrderType('Buy');
    }
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
