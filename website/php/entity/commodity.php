<?php
class Commodity {
  // Properties
 public $CommodityID;
 public $Symbol;
 public $CommodityName;
 public $CurrentPrice;
 public $LastUpdated;

  // set and get methods
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

  function fetchCommodity($con, $filter = "")
  {
    try {
        $query = "SELECT * FROM Commodity";
        if ($filter != "") {
            $query .= sprintf(" WHERE %s", $filter);
        }
        $result = mysqli_query($con, $query);
        if($result && mysqli_num_rows($result) > 0){
            $commodity = mysqli_fetch_all($result, MYSQLI_ASSOC);
            return $commodity;
        }
    } catch (Exception $e) {
      throw $e;
    }
  }
?>