<?php
    session_start();
    include("connection.php");
    include("controller/systemController.php");

    $symbol = 'WHEAT';

    echo('We will be testing '.$symbol.'.');

    echo('<br>The current price from the API for '.$symbol.' is: $');

    //Initialize CURL:
    $ch = curl_init('https://commodities-api.com/api/'.$endpoint.'?access_key='.$access_key.'');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //Store the data:
    $json = curl_exec($ch);
    curl_close($ch);
    //Decode JSON response:
    $response = json_decode($json, true);
    //Access the value, e.g. WHEAT:
    echo($response['data']['rates']['WHEAT']);

    echo('<br>The current Price in the database for '.$symbol.' is: ');

    $Commodity = fetchCommodity($con, "Symbol='$symbol'");
    echo($Commodity->get_CurrentPrice());

    echo(' and Date: ');

    echo($Commodity->get_LastUpdated());

    updateCommodityPrice($con, $symbol,$endpoint,$access_key);

    echo('<br>Before updated, the values of '.$symbol.' is:');
    echo('<br><tab>Price: '.$Commodity->get_CurrentPrice().'');
    echo('<br><tab>Date: '.$Commodity->get_LastUpdated().'');
    echo('<br>Once you refresh the page, the new API price should show that it is
    updated to the database and new entry in Price History inserted.');
    echo('<br>Here are the latest entries of the Price History:<br>');
    $CommodityID = $Commodity->get_CommodityID();
    //need to return history entity
    $newCommodityHistory = fetchCommodityHistory($con, "CommodityID='$CommodityID'");
    var_dump($newCommodityHistory);
?>