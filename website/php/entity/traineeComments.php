<?php
class TraineeComments {
  // Properties
 public $TraineeCommentID;
 public $ManagerUserID;
 public $TraineeUserID;
 public $TransactionHistoryID;
 public $Comment;
 public $DateCreated;
 public $LastUpdated;

  // set and get methods
  function get_TraineeCommentID() {
    return $this->TraineeCommentID;
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

  function set_TransactionHistoryID($TransactionHistoryID) {
    $this->TransactionHistoryID = $TransactionHistoryID;
  }
  function get_TransactionHistoryID() {
    return $this->TransactionHistoryID;
  }

  function set_Comment($Comment) {
    $this->Comment = $Comment;
  }
  function get_Comment() {
    return $this->Comment;
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

  function fetchTraineeComments($con, $filter = "")
  {
    try {
        $query = "SELECT * FROM TraineeComments";
        if ($filter != "") {
            $query .= sprintf(" WHERE %s", $filter);
        }
        $result = mysqli_query($con, $query);
        if($result && mysqli_num_rows($result) > 0){
            $traineeComments = mysqli_fetch_all($result, MYSQLI_ASSOC);
            return $traineeComments;
        }
    } catch (Exception $e) {
      throw $e;
    }
  }
?>