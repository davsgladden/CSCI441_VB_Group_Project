<?php
class CommodityHistory {
  // Properties
 public $CommodityHistoryID;
 public $CommodityID;
 public $Price;
 public $DateCreated;

  // set and get methods
  function set_CommodityHistoryID($CommodityHistoryID) {
    $this->CommodityHistoryID = $CommodityHistoryID;
  }
  function get_CommodityHistoryID() {
    return $this->CommodityHistoryID;
  }

  function set_CommodityID($CommodityID) {
    $this->CommodityID = $CommodityID;
  }
  function get_CommodityID() {
    return $this->CommodityID;
  }

  function set_Price($Price) {
    $this->Price = $Price;
  }
  function get_Price() {
    return $this->Price;
  }

  function set_DateCreated($DateCreated) {
    $this->DateCreated = $DateCreated;
  }
  function get_DateCreated() {
    return $this->DateCreated;
  }
}

/**
 * @throws Exception
 */
function fetchCommodityHistory($con, $filter = "")
{
    try {
        $query = "SELECT * FROM CommodityHistory";
        if ($filter != "") {
            $query .= sprintf(" WHERE %s", $filter);
        }
        $result = mysqli_query($con, $query);
        // if 1 row return CommodityHistory object
        if ($result && mysqli_num_rows($result) > 0 && mysqli_num_rows($result) < 2){
            $res = mysqli_fetch_array($result, MYSQLI_ASSOC);
            return getCommodityHistoy($res);
        }
        // if more than 1 row return array of CommodityHistory
        else {
            $commodityHistoryArr[] = array();
            while ($res = mysqli_fetch_array($result)) {
                $commodityHistory = getCommodityHistory($res);
                $commodityHistoryArr[] = $commodityHistory;
            }
            return $commodityHistoryArr;
        }
    } catch (Exception $e) {
        throw $e;
    }
}

/**
 * @param array $res
 * @return CommodityHistory
 */
function getCommodityHistory(array $res): CommodityHistory
{
    $commodityHistory = new CommodityHistory();
    $commodityHistory->set_CommodityHistoryID($res['CommodityHistoryID']);
    $commodityHistory->set_CommodityID($res['CommodityID']);
    $commodityHistory->set_Price($res['Price']);
    $commodityHistory->set_DateCreated($res['DateCreated']);
    return $commodityHistory;
}