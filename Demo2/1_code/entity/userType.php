<?php
class UserType {
  // Properties
 public $UserTypeID;
 public $UserType;
 public $DateCreated;

  // set and get methods
  function set_UserTypeID($UserTypeID) {
    $this->UserTypeID = $UserTypeID;
  }
  function get_UserTypeID() {
    return $this->UserTypeID;
  }

  function set_UserType($UserType) {
    $this->UserType = $UserType;
  }
  function get_UserType() {
    return $this->UserType;
  }

  function set_DateCreated($DateCreated) {
    $this->DateCreated = $DateCreated;
  }
  function get_DateCreated() {
    return $this->DateCreated;
  }
}

/**
 * @throws Exception
 */
function fetchUserType($con, $filter = "")
  {
    try {
        $query = "SELECT * FROM UserType";
        if ($filter != "") {
            $query .= sprintf(" WHERE %s", $filter);
        }
        $result = mysqli_query($con, $query);
        // if 1 row return usertype object
        if ($result && mysqli_num_rows($result) > 0 && mysqli_num_rows($result) < 2) {
            $res = mysqli_fetch_array($result, MYSQLI_ASSOC);
            return getUserType($res);
        }
        // if more than 1 row return array of usertype
        else {
            $userTypeArray[] = array();
            while ($res = mysqli_fetch_array($result)) {
                $userType = getUserType($res);
                $userTypeArray[] = $userType;
            }
            return $userTypeArray;
        }
    } catch (Exception $e) {
      throw $e;
    }
  }

/**
 * @param array $res
 * @return UserType
 */
  function getUserType(array $res): UserType
{
    $userType = new userType();
    $userType->set_UserTypeID($res['UserTypeID']);
    $userType->set_UserType($res['UserType']);
    $userType->set_DateCreated($res['DateCreated']);
    return $userType;
}
