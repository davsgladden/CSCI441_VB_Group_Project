<?php
class UserType {
  // Properties
 public $UserTypeID;
 public $UserType;
 public $DateCreated;

  // set and get methods
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

  function fetchUserType($con, $filter = "")
  {
    try {
        $query = "SELECT * FROM UserType";
        if ($filter != "") {
            $query .= sprintf(" WHERE %s", $filter);
        }
        $result = mysqli_query($con, $query);
        if($result && mysqli_num_rows($result) > 0){
            $userType = mysqli_fetch_all($result, MYSQLI_ASSOC);
            return $userType;
        }
    } catch (Exception $e) {
      throw $e;
    }
  }
?>