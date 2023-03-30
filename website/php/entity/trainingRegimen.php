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

  function fetchTrainingRegimen($con, $filter = "")
  {
    try {
        $query = "SELECT * FROM TrainingRegimen";
        if ($filter != "") {
            $query .= sprintf(" WHERE %s", $filter);
        }
        $result = mysqli_query($con, $query);
        if($result && mysqli_num_rows($result) > 0){
            $traineeRegimen = mysqli_fetch_all($result, MYSQLI_ASSOC);
            return $traineeRegimen;
        }
    } catch (Exception $e) {
      throw $e;
    }
  }
?>