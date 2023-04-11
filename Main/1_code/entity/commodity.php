<?php
class Commodity {
  // Properties
 public $CommodityID;
 public $Symbol;
 public $CommodityName;
 public $CurrentPrice;
 public $LastUpdated;

  // set and get methods
 function set_CommodityID($CommodityID) {
   $this->CommodityID = $CommodityID;
  }
  function get_CommodityID() {
    return $this->CommodityID;
  }

  function set_Symbol($Symbol) {
    $this->Symbol = $Symbol;
  }
  function get_Symbol() {
    return $this->Symbol;
  }

  function set_CommodityName($CommodityName) {
    $this->CommodityName = $CommodityName;
  }
  function get_CommodityName() {
    return $this->CommodityName;
  }

  function set_CurrentPrice($CurrentPrice) {
    $this->CurrentPrice = $CurrentPrice;
  }
  function get_CurrentPrice() {
    return $this->CurrentPrice;
  }

  function set_LastUpdated($LastUpdated) {
    $this->LastUpdated = $LastUpdated;
  }
  function get_LastUpdated() {
    return $this->LastUpdated;
  }
}

/**
 * @throws Exception
 */
function fetchCommodity($con, $filter = "")
{
    try {
        $query = "SELECT * FROM Commodity";
        if ($filter != "") {
            $query .= sprintf(" WHERE %s", $filter);
        }
        $result = mysqli_query($con, $query);
        // if 1 row return Commodity object
        if ($result && mysqli_num_rows($result) > 0 && mysqli_num_rows($result) < 2){
            $res = mysqli_fetch_array($result, MYSQLI_ASSOC);
            return getCommodities($res);
        }
        // if more than 1 row return array of Commodity
        else {
            $commodityArr[] = array();
            while ($res = mysqli_fetch_array($result)) {
                $commodity = getCommodities($res);
                $commodityArr[] = $commodity;
            }
            return $commodityArr;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

/**
 * @param array $res
 * @return Commodity
 */
function getCommodities(array $res): Commodity
{
    $commodity = new Commodity();
    $commodity->set_CommodityID($res['CommodityID']);
    $commodity->set_CommodityName($res['CommodityName']);
    $commodity->set_Symbol($res['Symbol']);
    $commodity->set_LastUpdated($res['LastUpdated']);
    $commodity->set_CurrentPrice($res['CurrentPrice']);
    return $commodity;
}

//enter commodity symbol in parameter and returns current price
function updateCommodity($con, $Commodity,$endpoint,$access_key){
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

    $symbol = $Commodity->get_Symbol();
    
    //Sometimes the API do not return all of the symbols every call, so this action must be skipped or an error will occur
    //test $symbol is set or not
    if (isset($response['data']['rates'][$symbol])){
      //Access the value, e.g. WHEAT:
      $newprice = $response['data']['rates'][$symbol];
      $convertedPrice = 1/$newprice;
    } else { 
      $convertedPrice = $Commodity->get_CurrentPrice();
    }

    //update db
    //set sql query
    $query = "UPDATE Commodity SET CurrentPrice = '".$convertedPrice."', LastUpdated = NOW() WHERE Symbol = '".$symbol."'";
    //excecute query to update current price information and date in db
    mysqli_query($con, $query);

    //return entity
    return fetchCommodity($con, "Symbol='$symbol'");

  } catch (Exception $e){
      //If symbol don't exist, the array could not be accessed and errow is thrown
      //If database connection is wrong, error is thrown
      echo $e->getMessage();
  }
}