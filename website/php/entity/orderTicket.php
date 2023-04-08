<?php
class Ticket {
  // Properties
 public $UserID;
 public $CommodityID;
 public $Amount;
 public $Total;
 public $OrderType;
 public $OrderDate;

  // set and get methods
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

  function set_Total($Total) {
    $this->Total = $Total;
  }
  function get_Total() {
    return $this->Total;
  }

  function set_OrderType($OrderType) {
    $this->OrderType = $OrderType;
  }
  function get_OrderType() {
    return $this->OrderType;
  }

  function set_OrderDate($OrderDate) {
    $this->OrderDate = $OrderDate;
  }
  function get_OrderDate() {
    return $this->OrderDate;
  }

}


function getTicket($res): Ticket
{
    $Ticket = new Ticket();
    $Ticket->set_UserID($res['UserID']);
    $Ticket->set_CommodityID($res['CommodityID']);
    $Ticket->set_Amount($res['Amount']);
    $Ticket->set_Total($res['Total']);
    $Ticket->set_OrderType($res['OrderType']);
    $Ticket->set_OrderDate($res['OrderDate']);
    return $Ticket;
}
