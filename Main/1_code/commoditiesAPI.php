<?php
    //'hqaq7um0j5ulet69q956j8awgp1x5y366y8w12xqz6mjvzj5upfmpqz7zau7'; //dg key
    //'3uiunaq72cjeo2y05yowutzu756r9tuo9h81urdj3fvgm4mpqdhbrc85d8dk'; //calvin key

    //calls API can return JSON of latest prices
    function apiCall(){
        //set API Endpoint and API key 
        $endpoint = 'latest';
        $access_key = '3uiunaq72cjeo2y05yowutzu756r9tuo9h81urdj3fvgm4mpqdhbrc85d8dk';
        try {
            //get new price
            //Initialize CURL:
            $ch = curl_init('https://commodities-api.com/api/'.$endpoint.'?access_key='.$access_key.'');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            //Store the data:
            $json = curl_exec($ch);
            curl_close($ch);

            //Decode JSON response:
            $response = json_decode($json, true);

            //return entity
            return ($response['data']['rates']);

        } catch (Exception $e){
            //If database connection is wrong, error is thrown
            echo $e->getMessage();
        }
    }