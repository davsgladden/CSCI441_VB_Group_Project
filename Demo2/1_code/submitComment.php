<?php
session_start();

include("connection.php");
include("functions.php");
include("controller/systemController.php");

    $comment = null;
    if (isset($_POST['comment'])) {
        $comment = $_POST['comment'];
    }
    echo $comment;
    $traineeComment = new TraineeComments();
    if (isset($_POST['var'])) {
        $res = json_decode($_POST['var'], true);
        $traineeComment = getTraineeComments($res);
    }

    $traineeComment->set_Comment($comment);
    //echo json_encode($traineeComment);
    try {
        insertTraineeComments($con, $traineeComment);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    ?>
<script>
    function clickAlert() {
        parent.location.reload();
    }
</script>
<!DOCTYPE html>
<html>
<body onload="clickAlert();">

</body>
</html>