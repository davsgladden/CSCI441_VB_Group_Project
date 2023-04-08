<?php
    session_start();

    include("connection.php");
    include("functions.php");
    include("controller/systemController.php");

    if(isset($_POST['var'])){
        $res = json_decode($_POST['var'],true);
        $transaction = getTransactionHistory($res);

        try {
            if ($transaction->get_OrderType() == 'Buy') {
                purchaseOrder($con, $transaction);
            } else if ($transaction->get_OrderType() == 'Sell') {

                sellOrder($con, $transaction);
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }