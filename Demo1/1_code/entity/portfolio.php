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
  function set_PortfolioID($PortfolioID) {
    $this->PortfolioID = $PortfolioID;
  }
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

/**
 * @throws Exception
 */
function fetchPortfolio($con, $filter = "")
{
    try {
        $query = "SELECT * FROM Portfolio";
        if ($filter != "") {
            $query .= sprintf(" WHERE %s", $filter);
        }
        $result = mysqli_query($con, $query);
        // if 1 row return Portfolio object
        if ($result && mysqli_num_rows($result) > 0 && mysqli_num_rows($result) < 2){
            $res = mysqli_fetch_array($result, MYSQLI_ASSOC);
            return getPortfolio($res);
        }
        // if more than 1 row return array of Portfolio
        else {
            $portfolioArr[] = array();
            while ($res = mysqli_fetch_array($result)) {
                $portfolio = getPortfolio($res);
                $portfolioArr[] = $portfolio;
            }
            return $portfolioArr;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

/**
 * @param $con
 * @param Portfolio $portfolio
 * Updates Portfolio table with Portfolio object
 */
function updatePortfolio($con, Portfolio $portfolio ){
    try{
        $query = "Update Portfolio 
                Set UserID = '$portfolio->UserID',
                    CommodityID = '$portfolio->CommodityID',
                    Amount = '$portfolio->Amount', 
                    PurchaseAvg = '$portfolio->PurchaseAvg', 
                    PositionStarted = '$portfolio->PositionStarted',
                    LastUpdated = '$portfolio->LastUpdated'
                   Where UserID = '$portfolio->UserID'
                        and CommodityID = '$portfolio->CommodityID'";
        mysqli_query($con, $query);
    } catch (exception $e) {
        echo $e->getMessage();
    }
}

/**
 * @param $con
 * @param Portfolio $portfolio
 * Inserts Portfolio object to Portfolio table
 */
function insertPortfolio($con, Portfolio $portfolio ){
    try{
        $query = "INSERT INTO Portfolio (UserID,CommodityID,Amount,PurchaseAvg,PositionStarted,LastUpdated) 
                VALUES ( $portfolio->UserID, 
                         $portfolio->CommodityID,
                        '$portfolio->Amount', 
                        '$portfolio->PurchaseAvg',
                        '$portfolio->PositionStarted', 
                        '$portfolio->LastUpdated')";
        mysqli_query($con, $query);
    } catch (exception $e) {
        echo $e->getMessage();
    }
}

/**
 * @param array $res
 * @return Portfolio
 */
function getPortfolio(array $res): Portfolio
{
    $portfolio = new Portfolio();
    $portfolio->set_PortfolioID($res['PortfolioID']);
    $portfolio->set_UserID($res['UserID']);
    $portfolio->set_CommodityID($res['CommodityID']);
    $portfolio->set_Amount($res['Amount']);
    $portfolio->set_PurchaseAvg($res['PurchaseAvg']);
    $portfolio->set_PositionStarted($res['PositionStarted']);
    $portfolio->set_LastUpdated($res['LastUpdated']);
    return $portfolio;
}