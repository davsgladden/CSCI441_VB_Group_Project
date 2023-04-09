<?php
class TrainingRegimen {
  // Properties
 public $TrainingRegimenID;
 public $TraineeUserID;
 public $RegimenStart;
 public $RegimenEnd;
 public $IsPerformanceReportGenerated;
 public $PerformanceReportDate;

  // set and get methods
  function set_TrainingRegimenID($TrainingRegimenID) {
    $this->TrainingRegimenID = $TrainingRegimenID;
  }
  function get_TrainingRegimenID() {
    return $this->TrainingRegimenID;
  }

  function set_TraineeUserID($TraineeUserID) {
    $this->TraineeUserID = $TraineeUserID;
  }
  function get_TraineeUserID() {
    return $this->TraineeUserID;
  }

  function set_RegimenStart($RegimenStart) {
    $this->RegimenStart = $RegimenStart;
  }
  function get_RegimenStart() {
    return $this->RegimenStart;
  }

  function set_RegimenEnd($RegimenEnd) {
    $this->RegimenEnd = $RegimenEnd;
  }
  function get_RegimenEnd() {
    return $this->RegimenEnd;
  }

  function set_IsPerformanceReportGenerated($IsPerformanceReportGenerated) {
    $this->IsPerformanceReportGenerated = $IsPerformanceReportGenerated;
  }
  function get_IsPerformanceReportGenerated() {
    return $this->IsPerformanceReportGenerated;
  }

  function set_PerformanceReportDate($PerformanceReportDate) {
    $this->PerformanceReportDate = $PerformanceReportDate;
  }
  function get_PerformanceReportDate() {
    return $this->PerformanceReportDate;
  }
}

/**
 * @throws Exception
 */
function fetchTrainingRegimen($con, $filter = "")
{
    try {
        $query = "SELECT * FROM TrainingRegimen";
        if ($filter != "") {
            $query .= sprintf(" WHERE %s", $filter);
        }
        $result = mysqli_query($con, $query);
        // if 1 row return TrainingRegimen object
        if ($result && mysqli_num_rows($result) > 0 && mysqli_num_rows($result) < 2){
            $res = mysqli_fetch_array($result, MYSQLI_ASSOC);
            return getTrainingRegimen($res);
        }
        // if more than 1 user return array of TrainingRegimen
        else {
            $trainingRegimenArr[] = array();
            while ($res = mysqli_fetch_array($result)) {
                $trainingRegimen = getTrainingRegimen($res);
                $trainingRegimenArr[] = $trainingRegimen;
            }
            return $trainingRegimenArr;
        }
    } catch (Exception $e) {
        throw $e;
    }
}

/**
 * @param array $res
 * @return TrainingRegimen
 */
function getTrainingRegimen(array $res): TrainingRegimen
{
    $trainingRegimen = new TrainingRegimen();
    $trainingRegimen->set_TrainingRegimenID($res['TrainingRegimenID']);
    $trainingRegimen->set_TraineeUserID($res['TraineeUserID']);
    $trainingRegimen->set_RegimenStart($res['RegimenStart']);
    $trainingRegimen->set_RegimenEnd($res['RegimenEnd']);
    $trainingRegimen->set_IsPerformanceReportGenerated($res['IsPerformanceReportGenerated']);
    $trainingRegimen->set_PerformanceReportDate($res['PerformanceReportDate']);
    return $trainingRegimen;
}