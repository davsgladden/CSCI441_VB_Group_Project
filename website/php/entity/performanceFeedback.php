<?php
class PerformanceFeedback {
  // Properties
 public $PerformanceFeedbackID;
 public $ManagerUserID;
 public $TraineeUserID;
 public $TrainingRegimenID;
 public $DateCreated;
 public $LastUpdated;

  // set and get methods
  function get_PerformanceFeedbackID() {
    return $this->PerformanceFeedbackID;
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

  function set_TrainingRegimenID($TrainingRegimenID) {
    $this->TrainingRegimenID = $TrainingRegimenID;
  }
  function get_TrainingRegimenID() {
    return $this->TrainingRegimenID;
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
}

  function fetchPerformanceFeedback($con, $filter = "")
  {
    try {
        $query = "SELECT * FROM PerformanceFeedback";
        if ($filter != "") {
            $query .= sprintf(" WHERE %s", $filter);
        }
        $result = mysqli_query($con, $query);
        if($result && mysqli_num_rows($result) > 0){
            $performanceFeedback = mysqli_fetch_all($result, MYSQLI_ASSOC);
            return $performanceFeedback;
        }
    } catch (Exception $e) {
      throw $e;
    }
  }
?>