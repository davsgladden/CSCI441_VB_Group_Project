<?php
class TraineeManagement {
  // Properties
 public $TraineeManagementID;
 public $ManagerUserID;
 public $TraineeUserID;
 public $DateCreated;
 public $LastUpdated;
 public $IsActive;

  // set and get methods
  function get_TraineeManagementID() {
    return $this->TraineeManagementID;
  }

  function set_ManagerUserID($ManagerUserID) {
    $this->ManagerUserID = $ManagerUserID;
  }
  function get_ManagerUserID() {
    return $this->ManagerUserID;
  }

  function set_TraineeUserID($TraineeUserID) {
    $this->TraineeUserID = $TraineeUserID;
  }
  function get_TraineeUserID() {
    return $this->TraineeUserID;
  }

  function set_DateCreated($DateCreated) {
    $this->DateCreated = $DateCreated;
  }
  function get_DateCreated() {
    return $this->DateCreated;
  }

  function set_LastUpdated($LastUpdated) {
    $this->LastUpdated = $LastUpdated;
  }
  function get_LastUpdated() {
    return $this->LastUpdated;
  }

  function set_IsActive($IsActive) {
    $this->IsActive = $IsActive;
  }
  function get_IsActive() {
    return $this->IsActive;
  }
}

  function fetchTraineeManagement($con, $filter = "")
  {
    try {
        $query = "SELECT * FROM TraineeManagement";
        if ($filter != "") {
            $query .= sprintf(" WHERE %s", $filter);
        }
        $result = mysqli_query($con, $query);
        if($result && mysqli_num_rows($result) > 0){
            $traineeManagement = mysqli_fetch_all($result, MYSQLI_ASSOC);
            return $traineeManagement;
        }
    } catch (Exception $e) {
      throw $e;
    }
  }
?>