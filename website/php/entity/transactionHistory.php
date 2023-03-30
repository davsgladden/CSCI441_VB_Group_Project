<?php
class TransactionHistory {
  // Properties
 public $TransactionHistoryID;
 public $UserID;
 public $CommodityID;
 public $Amount;
 public $Price;
 public $TransactionPrice;
 public $TransactionDate;


  // set and get methods
  function get_TransactionHistoryID() {
    return $this->TransactionHistoryID;
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

  function set_Price($Price) {
    $this->Price = $Price;
  }
  function get_Price() {
    return $this->Price;
  }

  function set_TransactionPrice($TransactionPrice) {
    $this->TransactionPrice = $TransactionPrice;
  }
  function get_TransactionPrice() {
    return $this->TransactionPrice;
  }

  function set_TransactionDate($TransactionDate) {
    $this->TransactionDate = $TransactionDate;
  }
  function get_TransactionDate() {
    return $this->TransactionDate;
  }
}

  function fetchTransactionHistory($con, $filter = "")
  {
    try {
        $query = "SELECT * FROM TransactionHistory";
        if ($filter != "") {
            $query .= sprintf(" WHERE %s", $filter);
        }
        $result = mysqli_query($con, $query);
        if($result && mysqli_num_rows($result) > 0){
            $transactionHistoryID = mysqli_fetch_all($result, MYSQLI_ASSOC);
            return $transactionHistoryID;
        }
    } catch (Exception $e) {
      throw $e;
    }
  }
?>