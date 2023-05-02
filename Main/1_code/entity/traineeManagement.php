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
  function set_TraineeManagementID($TraineeManagementID) {
    $this->TraineeManagementID = $TraineeManagementID;
  }
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

/**
 * @throws Exception
 */
function fetchTraineeManagement($con, $filter = "")
{
    try {
        $query = "SELECT * FROM TraineeManagement";
        if ($filter != "") {
            $query .= sprintf(" WHERE %s", $filter);
        }
        $result = mysqli_query($con, $query);
        // if 1 row return TraineeManagement object
        if ($result && mysqli_num_rows($result) > 0 && mysqli_num_rows($result) < 2){
            $res = mysqli_fetch_array($result, MYSQLI_ASSOC);
            return getTraineeManagement($res);
        }
        // if more than 1 user return array of TraineeManagement
        else {
            $traineeManagementArr[] = array();
            while ($res = mysqli_fetch_array($result)) {
                $traineeManagement = getTraineeManagement($res);
                $traineeManagementArr[] = $traineeManagement;
            }
            return $traineeManagementArr;
        }
    } catch (Exception $e) {
        throw $e;
    }
}

/**
 * @param $con
 * @param TraineeManagement $traineeManagement
 * Inserts TraineeManagement object to TraineeManagement table
 */
function insertTraineeManagement($con, TraineeManagement $traineeManagement ){
    try{
        $query = "INSERT INTO TraineeManagement (ManagerUserID,TraineeUserID,IsActive) 
                VALUES ( $traineeManagement->ManagerUserID, 
                         $traineeManagement->TraineeUserID,
                         $traineeManagement->IsActive)";
        mysqli_query($con, $query);
    } catch (exception $e) {
        echo $e->getMessage();
    }
}


/**
 * @param array $res
 * @return TraineeManagement
 */
function getTraineeManagement(array $res): TraineeManagement
{
    $traineeManagement = new TraineeManagement();
    $traineeManagement->set_TraineeManagementID($res['TraineeManagementID']);
    $traineeManagement->set_ManagerUserID($res['ManagerUserID']);
    $traineeManagement->set_TraineeUserID($res['TraineeUserID']);
    $traineeManagement->set_DateCreated($res['DateCreated']);
    $traineeManagement->set_LastUpdated($res['LastUpdated']);
    $traineeManagement->set_IsActive($res['IsActive']);
    return $traineeManagement;
}