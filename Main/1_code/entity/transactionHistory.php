<?php
class TransactionHistory {
  // Properties
 public $TransactionHistoryID;
 public $UserID;
 public $CommodityID;
 public $Amount;
 public $Price;
 public $TransactionPrice;
 public $OrderType;
 public $TransactionDate;


  // set and get methods
  function set_TransactionHistoryID($TransactionHistoryID) {
    $this->TransactionHistoryID = $TransactionHistoryID;
  }
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

  function set_OrderType($OrderType) {
    $this->OrderType = $OrderType;
  }
  function get_OrderType() {
    return $this->OrderType;
  }

  function set_TransactionDate($TransactionDate) {
    $this->TransactionDate = $TransactionDate;
  }
  function get_TransactionDate() {
    return $this->TransactionDate;
  }
}

/**
 * @throws Exception
 */
function fetchTransactionHistory($con, $filter = "")
{
    try {
        $query = "SELECT * FROM TransactionHistory";
        if ($filter != "") {
            $query .= sprintf(" WHERE %s", $filter);
        }
        $result = mysqli_query($con, $query);
        // if 1 row return TransactionHistory object
        if ($result && mysqli_num_rows($result) > 0 && mysqli_num_rows($result) < 2){
            $res = mysqli_fetch_array($result, MYSQLI_ASSOC);
            return getTransactionHistory($res);
        }
        // if more than 1 row return array of TransactionHistory
        else {
            $transactionHistoryArr[] = array();
            while ($res = mysqli_fetch_array($result)) {
                $transactionHistory = getTransactionHistory($res);
                $transactionHistoryArr[] = $transactionHistory;
            }
            return $transactionHistoryArr;
        }
    } catch (Exception $e) {
        throw $e;
    }
}

/**
 * @param $con
 * @param TransactionHistory $transaction
 * Inserts TransactionHistory object to TransactionHistory table
 */
function insertTransactionHistory($con, TransactionHistory $transaction ){
    try{
        $query = "INSERT INTO TransactionHistory (UserID,CommodityID,Amount,Price, TransactionPrice, OrderType, TransactionDate) 
                VALUES ( $transaction->UserID, 
                         $transaction->CommodityID,
                         $transaction->Amount, 
                         $transaction->Price,
                         $transaction->TransactionPrice, 
                        '$transaction->OrderType',
                        '$transaction->TransactionDate')";
        mysqli_query($con, $query);
    } catch (exception $e) {
        echo $e->getMessage();
    }
}

/**
 * @param array $res
 * @return TransactionHistory
 */
function getTransactionHistory(array $res): TransactionHistory
{
    $transactionHistory = new TransactionHistory();
    $transactionHistory->set_TransactionHistoryID($res['TransactionHistoryID']);
    $transactionHistory->set_UserID($res['UserID']);
    $transactionHistory->set_CommodityID($res['CommodityID']);
    $transactionHistory->set_Amount($res['Amount']);
    $transactionHistory->set_Price($res['Price']);
    $transactionHistory->set_TransactionPrice($res['TransactionPrice']);
    $transactionHistory->set_OrderType($res['OrderType']);
    $transactionHistory->set_TransactionDate($res['TransactionDate']);
    return $transactionHistory;
}