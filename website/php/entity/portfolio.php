<?php
class Portfolio {
  // Properties
    public $PortfolioID;
    public $UserID;
    public $CommodityID;
    public $Amount;
    public $PurchaseAvg;
    public $PositionStarted;
    public $LastUpdated;

  // set and get methods
  function get_PortfolioID() {
    return $this->PortfolioID;
  }

  function set_UserID($UserID) {
    $this->UserID = $UserID;
  }
  function get_UserID() {
    return $this->UserID;
  }

  function set_CommodityID($CommodityID) {
    $this->CommodityID = $CommodityID;
  }
  function get_CommodityID() {
    return $this->CommodityID;
  }

  function set_Amount($Amount) {
    $this->Amount = $Amount;
  }
  function get_Amount() {
    return $this->Amount;
  }

  function set_PurchaseAvg($PurchaseAvg) {
    $this->PurchaseAvg = $PurchaseAvg;
  }
  function get_PurchaseAvg() {
    return $this->PurchaseAvg;
  }

  function set_PositionStarted($PositionStarted) {
    $this->PositionStarted = $PositionStarted;
  }
  function get_PositionStarted() {
    return $this->PositionStarted;
  }

  function set_LastUpdated($LastUpdated) {
    $this->LastUpdated = $LastUpdated;
  }
  function get_LastUpdated() {
    return $this->LastUpdated;
  }
}

  function fetchPortfolio($con, $userId)
  {
    try {
        $query = "SELECT * FROM Portfolio WHERE UserID = '$userId'";
        $result = mysqli_query($con, $query);
        if($result && mysqli_num_rows($result) > 0){
            $portfolio = mysqli_fetch_all($result, MYSQLI_ASSOC);
            return $portfolio;
        }
    } catch (Exception $e) {
      throw $e;
    }
  }

?>