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

    echo('<br>The current price and date for '.$symbol.' is: ');

    $Commodity = fetchCommodity($con, "Symbol='$symbol'");
    echo($Commodity->get_CurrentPrice());

    echo(' and: ');

    echo($Commodity->get_LastUpdated());

    updateCommodityPrice($con, $symbol,$endpoint,$access_key);

    echo('<br>Now updated, the new values of '.$symbol.' is:');
    echo('<br>Price: '.$Commodity->get_CurrentPrice().'');
    echo('<br>Date: '.$Commodity->get_LastUpdated().'');

    echo('Here are the latest entries of the Price History:');
    //echo('<br>'fetchCommodityHistory($con));
?>