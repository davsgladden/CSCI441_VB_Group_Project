<?php
    session_start();
    include("connection.php");
    include("controller/systemController.php");

    $endpoint = 'latest';
    $access_key = '3uiunaq72cjeo2y05yowutzu756r9tuo9h81urdj3fvgm4mpqdhbrc85d8dk';
    
    //We will be testing WHEAT
    $symbol = 'WHEAT';
    $Commodity = fetchCommodity($con, "Symbol = '$symbol'");
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

    //Sometimes the API do not return all of the symbols every call, so this action must be skipped or an error will occur
    //test $symbol is set or not
    if (isset($response['data']['rates'][$symbol])){
        //Access the value, e.g. WHEAT:
        $newprice = $response['data']['rates'][$symbol];
        $convertedPrice = 1/$newprice;
      } else { 
        $convertedPrice = $Commodity->get_CurrentPrice();
      }
    echo($convertedPrice);

    //Update price
    $newCommodity = updateCommodityPrice($con, $symbol);

    //Display current data
    echo('<br><br>Before the update, the Price of '.$symbol.' in the Database is: $');
    echo($Commodity->get_CurrentPrice());
    echo(' and Date: ');
    echo($Commodity->get_LastUpdated());
    
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