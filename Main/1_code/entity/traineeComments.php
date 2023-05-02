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
  function set_TraineeCommentID($TraineeCommentID) {
    $this->TraineeCommentID = $TraineeCommentID;
  }
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

/**
 * @throws Exception
 */
function fetchTraineeComments($con, $filter = "")
{
    try {
        $query = "SELECT * FROM TraineeComments";
        if ($filter != "") {
            $query .= sprintf(" WHERE %s", $filter);
        }
        $result = mysqli_query($con, $query);
        // if 1 row return TraineeComments object
        if ($result && mysqli_num_rows($result) > 0 && mysqli_num_rows($result) < 2){
            $res = mysqli_fetch_array($result, MYSQLI_ASSOC);
            return getTraineeComments($res);
        }
        // if more than 1 user return array of TraineeComments
        else {
            $traineeCommentsArr[] = array();
            while ($res = mysqli_fetch_array($result)) {
                $traineeComments = getTraineeComments($res);
                $traineeCommentsArr[] = $traineeComments;
            }
            return $traineeCommentsArr;
        }
    } catch (Exception $e) {
        throw $e;
    }
}

/**
 * @param $con
 * @param TraineeComments $traineeComments
 * Inserts TraineeComments object to TraineeComments table
 */
function insertTraineeComments($con, TraineeComments $traineeComments ){
    try{
        $query = "INSERT INTO TraineeComments (ManagerUserID,TraineeUserID, TransactionHistoryID, Comment) 
                VALUES ( $traineeComments->ManagerUserID, 
                         $traineeComments->TraineeUserID,
                         $traineeComments->TransactionHistoryID,
                        '$traineeComments->Comment')";
        mysqli_query($con, $query);
    } catch (exception $e) {
        echo $e->getMessage();
    }
}

/**
 * @param array $res
 * @return TraineeComments
 */
function getTraineeComments(array $res): TraineeComments
{
    $traineeComments = new TraineeComments();
    $traineeComments->set_TraineeCommentID($res['TraineeCommentID']);
    $traineeComments->set_ManagerUserID($res['ManagerUserID']);
    $traineeComments->set_TraineeUserID($res['TraineeUserID']);
    $traineeComments->set_TransactionHistoryID($res['TransactionHistoryID']);
    $traineeComments->set_Comment($res['Comment']);
    $traineeComments->set_DateCreated($res['DateCreated']);
    $traineeComments->set_LastUpdated($res['LastUpdated']);
    return $traineeComments;
}