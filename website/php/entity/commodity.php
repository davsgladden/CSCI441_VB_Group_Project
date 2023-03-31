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
        throw $e;
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
