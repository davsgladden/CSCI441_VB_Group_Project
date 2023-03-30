<?php
class CommodityHistory {
  // Properties
 public $CommodityHistoryID;
 public $CommodityID;
 public $Price;
 public $DateCreated;

  // set and get methods
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

  function fetchCommodityHistory($con, $filter = "")
  {
    try {
        $query = "SELECT * FROM CommodityHistory";
        if ($filter != "") {
            $query .= sprintf(" WHERE %s", $filter);
        }
        $result = mysqli_query($con, $query);
        if($result && mysqli_num_rows($result) > 0){
            $commodityHistory = mysqli_fetch_all($result, MYSQLI_ASSOC);
            return $commodityHistory;
        }
    } catch (Exception $e) {
      throw $e;
    }
  }
?>