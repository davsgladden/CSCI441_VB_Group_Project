<?php
class Users {
  // Properties
 public $ID;
 public $UserID;
 public $UserName;
 public $Password;
 public $UserTypeID;
 public $AvailableFunds;
 public $IsActive;
 public $DateCreated;
 public $LastLogin;

  // set and get methods
  function get_ID() {
    return $this->ID;
  }

  function get_UserID() {
    return $this->UserID;
  }

  function set_UserName($UserName) {
    $this->UserName = $UserName;
  }
  function get_UserName() {
    return $this->UserName;
  }

  function set_Password($Password) {
    $this->Password = $Password;
  }
  function get_Password() {
    return $this->Password;
  }

  function set_UserTypeID($UserTypeID) {
    $this->UserTypeID = $UserTypeID;
  }
  function get_UserTypeID() {
    return $this->UserTypeID;
  }

  function set_AvailableFunds($AvailableFunds) {
    $this->AvailableFunds = $AvailableFunds;
  }
  function get_AvailableFunds() {
    return $this->AvailableFunds;
  }

  function set_IsActive($IsActive) {
    $this->IsActive = $IsActive;
  }
  function get_IsActive() {
    return $this->IsActive;
  }

  function set_DateCreated($DateCreated) {
    $this->DateCreated = $DateCreated;
  }
  function get_DateCreated() {
    return $this->DateCreated;
  }

  function set_LastLogin($LastLogin) {
    $this->LastLogin = $LastLogin;
  }
  function get_LastLogin() {
    return $this->LastLogin;
  }
}

  function fetchUsers($con, $filter = "")
  {
    try {
        $query = "SELECT * FROM Users";
        if ($filter != "") {
            $query .= sprintf(" WHERE %s", $filter);
        }
        $result = mysqli_query($con, $query);
        if($result && mysqli_num_rows($result) > 0){
            $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
            return $users;
        }
    } catch (Exception $e) {
      throw $e;
    }
  }
?>