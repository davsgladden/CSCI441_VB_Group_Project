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
  function set_ID($id) {
    $this->ID = $id;
  }
  function get_ID() {
    return $this->ID;
  }

  function set_UserID($UserID) {
    $this->UserID = $UserID;
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

  function fetchUser($con, $id)
  {
    try {
        $query = "SELECT * FROM Users Where ID = '$id' Limit 1";
        $result = mysqli_query($con, $query);
        if($result && mysqli_num_rows($result) > 0){
            $res = mysqli_fetch_all($result, MYSQLI_ASSOC);
                $user = new users();
                $user->set_id($res[0]['ID']);
                $user->set_UserID($res[0]['UserID']);
                $user->set_UserName($res[0]['UserName']);
                $user->set_Password($res[0]['Password']);
                $user->set_UserTypeID($res[0]['UserTypeID']);
                $user->set_AvailableFunds($res[0]['AvailableFunds']);
                $user->set_IsActive($res[0]['IsActive']);
                $user->set_DateCreated($res[0]['DateCreated']);
                $user->set_LastLogin($res[0]['LastLogin']);
            return $user;
        }
    } catch (Exception $e) {
      throw $e;
    }
  }
?>