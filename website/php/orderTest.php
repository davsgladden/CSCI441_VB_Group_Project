<?php
    session_start();
    include("connection.php");
    include("controller/systemController.php");

    $test = 'buy';

    if ($test = 'sell') {
        /** sell order test */
        $user_data = fetchUser($con, "ID = '2'");
        $Commodity = fetchCommodity($con, "CommodityID = 3");
        $Amount = 1;
        $Price = $Commodity->get_CurrentPrice();
        $Total = $Amount * $Price;
        date_default_timezone_set('America/Chicago'); //Central timezone
        $Transaction = new TransactionHistory();
        $Transaction->set_UserID($user_data->get_ID());
        $Transaction->set_CommodityID($Commodity->get_CommodityID());
        $Transaction->set_Amount($Amount);
        $Transaction->set_Price($Price);
        $Transaction->set_TransactionPrice($Total);
        $Transaction->set_OrderType('Sell');
        $Transaction->set_TransactionDate(date('Y-m-d H:i:s'));
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
    }
    if ($test = 'buy') {
        /** purchase order test */
        $user_data = fetchUser($con, "ID = '2'");
        $Commodity = fetchCommodity($con, "CommodityID = 3");
        $Amount = 1;
        $Price = $Commodity->get_CurrentPrice();
        $Total = $Amount * $Price;
        date_default_timezone_set('America/Chicago'); //Central timezone
        $Transaction = new TransactionHistory();
        $Transaction->set_UserID($user_data->get_ID());
        $Transaction->set_CommodityID($Commodity->get_CommodityID());
        $Transaction->set_Amount($Amount);
        $Transaction->set_Price($Price);
        $Transaction->set_TransactionPrice($Total);
        $Transaction->set_OrderType('Buy');
        $Transaction->set_TransactionDate(date('Y-m-d H:i:s'));
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
    }
