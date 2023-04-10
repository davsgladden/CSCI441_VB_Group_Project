<?php
    session_start();
    include("connection.php");
    include("controller/systemController.php");

    //We will be testing WHEAT
    $symbol = 'POTATOES';
    echo('We will be testing '.$symbol.'.');
    echo('<br><br>The latest price data from the API for '.$symbol.' is: $');

    //Call to API and get data
    //Initialize CURL:
    $ch = curl_init('https://commodities-api.com/api/'.$endpoint.'?access_key='.$access_key.'');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //Store the data:
    $json = curl_exec($ch);
    curl_close($ch);
    //Decode JSON response:
    $response = json_decode($json, true);
    //Access the value, e.g. WHEAT:
    $newprice = $response['data']['rates'][$symbol];
    $convertedPrice = 1/$newprice;
    echo($convertedPrice);

    //Update price
    $newCommodity = updateCommodityPrice($con, $symbol,$endpoint,$access_key);

    //Display new data
    echo('<br><br>Before the update, the Price of '.$symbol.' in the Database is: $');
    echo($newCommodity->get_CurrentPrice());
    echo(' and Date: ');
    echo($newCommodity->get_LastUpdated());
    
    echo('<br>Once you refresh the page, the new API price should show that it is
    updated to the Database and new entry in Price History inserted.');
    echo('<br>The Price in the Database should match the Price of the API.');
    
    //Find commodity history, it should include the newest entry
    echo('<br><br>Here are the latest entries of the Price History:');
    $CommodityID = $newCommodity->get_CommodityID();
    $newCommodityHistory = fetchCommodityHistory($con, "CommodityID='$CommodityID'");
    echo('<br>The last Date of the history should match the data displayed above once reloaded.<br>');
    var_dump($newCommodityHistory);
?>