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
  function set_PerformanceFeedbackID($PerformanceFeedbackID) {
    $this->PerformanceFeedbackID = $PerformanceFeedbackID;
  }
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

/**
 * @throws Exception
 */
function fetchPerformanceFeedback($con, $filter = "")
{
    try {
        $query = "SELECT * FROM PerformanceFeedback";
        if ($filter != "") {
            $query .= sprintf(" WHERE %s", $filter);
        }
        $result = mysqli_query($con, $query);
        // if 1 row return PerformanceFeedback object
        if ($result && mysqli_num_rows($result) > 0 && mysqli_num_rows($result) < 2){
            $res = mysqli_fetch_array($result, MYSQLI_ASSOC);
            return getPerformanceFeedback($res);
        }
        // if more than 1 row return array of PerformanceFeedback
        else {
            $performanceFeedbackArr[] = array();
            while ($res = mysqli_fetch_array($result)) {
                $performanceFeedback = getPerformanceFeedback($res);
                $performanceFeedbackArr[] = $performanceFeedback;
            }
            return $performanceFeedbackArr;
        }
    } catch (Exception $e) {
        throw $e;
    }
}

/**
 * @param array $res
 * @return PerformanceFeedback
 */
function getPerformanceFeedback(array $res): PerformanceFeedback
{
    $performanceFeedback = new PerformanceFeedback();
    $performanceFeedback->set_PerformanceFeedbackID($res['PerformanceFeedbackID']);
    $performanceFeedback->set_ManagerUserID($res['ManagerUserID']);
    $performanceFeedback->set_TraineeUserID($res['TraineeUserID']);
    $performanceFeedback->set_TrainingRegimenID($res['TrainingRegimen']);
    $performanceFeedback->set_DateCreated($res['DateCreated']);
    $performanceFeedback->set_LastUpdated($res['LastUpdated']);
    return $performanceFeedback;
}