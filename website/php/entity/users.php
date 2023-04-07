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

/**
 * @throws Exception
 */
function fetchUser($con, $filter = "")
  {
    try {
        $query = "SELECT * FROM Users";
        if ($filter != "") {
            $query .= sprintf(" WHERE %s", $filter);
        }
        $result = mysqli_query($con, $query);
        // if 1 user return user object
        if ($result && mysqli_num_rows($result) > 0 && mysqli_num_rows($result) < 2){
            $res = mysqli_fetch_array($result, MYSQLI_ASSOC);
            return getUsers($res);
        }
        // if more than 1 user return array of users
        else {
            $userArr[] = array();
            while ($res = mysqli_fetch_array($result)) {
                $user = getUsers($res);
                $userArr[] = $user;
            }
            return $userArr;
        }
    } catch (Exception $e) {
      throw $e;
    }
  }

/**
 * @param $con
 * @param Users $user
 * Inserts User object to Users table
 */
  function insertUser($con, Users $user ){
    try{
        $query = "INSERT INTO users (UserID,UserName,Password,UserTypeID, AvailableFunds, IsActive) 
                VALUES ( $user->UserID, 
                        '$user->UserName',
                        '$user->Password', 
                         $user->UserTypeID,
                         $user->AvailableFunds, 
                         $user->IsActive)";
        mysqli_query($con, $query);
    } catch (exception $e) {
        throw $e;
    }
  }

/**
 * @param $con
 * @param Users $user
 * Updates Users table with User object
 */
function updateUser($con, Users $user ){
    try{
        $query = "Update Users 
                Set UserName = '$user->UserName',
                    Password = '$user->Password',
                    UserTypeID = $user->UserTypeID, 
                    AvailableFunds = $user->AvailableFunds, 
                    IsActive = $user->IsActive,
                    LastLogin = '$user->LastLogin'
                   Where UserID = '$user->UserID'";
        mysqli_query($con, $query);
    } catch (exception $e) {
        throw $e;
    }
}

/**
 * @param array $res
 * @return Users
 */
function getUsers(array $res): Users
{
    $user = new users();
    $user->set_id($res['ID']);
    $user->set_UserID($res['UserID']);
    $user->set_UserName($res['UserName']);
    $user->set_Password($res['Password']);
    $user->set_UserTypeID($res['UserTypeID']);
    $user->set_AvailableFunds($res['AvailableFunds']);
    $user->set_IsActive($res['IsActive']);
    $user->set_DateCreated($res['DateCreated']);
    $user->set_LastLogin($res['LastLogin']);
    return $user;
}

